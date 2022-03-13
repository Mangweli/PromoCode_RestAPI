<?php

namespace App\Repositories;

use App\Interfaces\PromoCodeRepositoryInterface;
use App\Http\Resources\V1\PromoCodeResource;
use App\Models\PromoCode;
use Carbon\Carbon;
use App\Traits\LocationMatrix;

class PromoCodeRepository implements PromoCodeRepositoryInterface
{
    use LocationMatrix;

    public function getAllPromocodes(int $pagination=10)
    {
        return PromoCodeResource::collection(PromoCode::paginate($pagination));
    }

    public function getPromocodeFilteredByKey(string $key, $value, int $pagination = 10)
    {
       return PromoCodeResource::collection(PromoCode::where($key, $value)->paginate($pagination));
    }

    public function createPromoCode(array $promoDetails)
    {
        $promoCode =  PromoCode::create($promoDetails);
        return new PromoCodeResource($promoCode);
    }

    public function checkPromoValidity($promoCodeName, $origin=null, $destination=null)
    {
        $promo = PromoCode::where("promo_code", $promoCodeName)
                            ->where('disabled', 0)
                            ->where('start_date','<', Carbon::now())
                            ->where('end_date', '>', Carbon::now())
                            ->get();

        if(sizeof($promo) < 1) return false;

        if(is_null($origin) && !is_null($promo[0]->pick_up_address)) return false;

        if(is_null($destination) && !is_null($promo[0]->drop_off_address)) return false;

        if(is_null($promo[0]->pick_up_address) && is_null($promo[0]->pick_up_address)) return true;

        if(!is_null($promo[0]->pick_up_address)) {
            $originLatLong    = $this->getLatLong($origin);
            $promolatlong     = explode(",", $promo[0]->pick_up_ll);
            $distanceVariance = $this->getDistanceDifference($originLatLong['lat'], $originLatLong['long'], $promolatlong[0], $promolatlong[1]);

            if($distanceVariance > (int)$promo[0]->pick_up_variance) return false;
        }

        if(!is_null($promo[0]->drop_off_address)) {
            $destLatLong      = $this->getLatLong($destination);
            $promolatlong     = explode(",", $promo[0]->drop_off_ll);
            $distanceVariance = $this->getDistanceDifference($destLatLong['lat'], $destLatLong['long'], $promolatlong[0], $promolatlong[1]);

            if($distanceVariance > $promo[0]->drop_off_variance) return false;
        }
        $results['promo']    = PromoCodeResource::collection($promo);
        $results['polyline'] = $this->getPolyLine($destination, $origin, 'driving');

       return   $results;
    }


    public function setPromoCodeDetails($promoCodeName, array $promoDetails)
    {
        return PromoCode::where("promo_code", $promoCodeName)
                        ->update($promoDetails);
    }
}
