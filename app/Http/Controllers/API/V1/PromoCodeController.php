<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\UpdatePromoCodeRequest;
use App\Http\Resources\V1\PromoCodeResource;
use App\Interfaces\PromoCodeRepositoryInterface;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\BaseController;
use Validator;

class PromoCodeController extends BaseController
{

    private PromoCodeRepositoryInterface $promoCodeRepository;

    public function __construct(PromoCodeRepositoryInterface $promoCodeRepository)
    {
        $this->promoCodeRepository = $promoCodeRepository;
    }

    public function index(Request $request)
    {
        try {
            $promocodes = $request->has('disabled') ? $this->promoCodeRepository->getPromocodeFilteredByKey('disabled', $request->get('disabled')) : $this->promoCodeRepository->getAllPromocodes(10);
            return $this->handleResponse($promocodes, 'PromoCodes have been retrieved!');
        }
        catch (\Throwable $th) {
            return $this->handleError('Error.', ['error'=>'Unable to process your request']);
        }

    }

    public function store(Request $request)
    {
        try {
            $input     = $request->all();
            $validator = Validator::make($input, [
                'promo_code'                => 'required',
                'country'                   => 'required',
                'city'                      => 'required',
                'pick_up_address'           => 'required',
                'drop_off_address'          => 'required',
                'start_date'                => 'required|date',
                'end_date'                  => 'required|date',
                'amount'                    => 'required',
                'number_of_usage_per_rider' => 'required|numeric',
                'max_total_amount'          => 'required',
                'pick_up_ll'                => 'required',
                'drop_off_ll'               => 'required',
                'pick_up_variance'          => 'required',
                'drop_off_variance'         => 'required'
            ]);

            if($validator->fails()){
                return $this->handleError($validator->errors());
            }
            $promoCode =  PromoCode::create($request->all());
            return $this->handleResponse($this->promoCodeRepository->createPromoCode($input), 'Promocode created!');
        }
        catch (\Throwable $th) {
            return $this->handleError('Error.', ['error'=>'Unable to process your request']);
        }

    }

    public function validatePromoCode($promoCode, $origin=null, $destination=null) {
        try {
            $isValid = $this->promoCodeRepository->checkPromoValidity($promoCode, $origin, $destination);
            return $isValid ? $this->handleResponse($isValid, 'Promocode is valid') : $this->handleError('Error.', ['error'=>'Promocode is Invalid']);
        }
        catch (\Throwable $th) {
            return $this->handleError('Error.', ['error'=>'Unable to process your request']);
       }
    }

    public function setStatusPromoCode(Request $request, $promoCodeName)
    {
        $input     = $request->all();
        $validator = Validator::make($input, [
            'disabled'                => 'required|numeric|in:0,1'
        ]);

        if($validator->fails()){
            return $this->handleError($validator->errors());
        }

        try {
            if($request->has('disabled')) {
                return $this->handleResponse($this->promoCodeRepository->setPromoCodeDetails($promoCodeName, ['disabled' => trim($request->get('disabled'))]), 'Promocode status changed');
            }

        }
        catch (\Throwable $th) {
            return $this->handleError('Error.', ['error'=>'Unable to process your request']);
        }

    }

    public function setLocationVariance(Request $request, $promoCodeName)
    {
        $variance = [];
        try {
            if($request->has('pick_up_variance')) {
                $variance['pick_up_variance'] = trim($request->get('pick_up_variance'));
            }

            if($request->has('drop_off_variance')) {
                $variance['drop_off_variance'] = trim($request->get('drop_off_variance'));
            }

            if(empty($variance)) {
                return $this->handleError('Error.', ['error'=>'No variance Available']);
            }

            return $this->handleResponse($this->promoCodeRepository->setPromoCodeDetails($promoCodeName, $variance) , 'Promocode variance changed!');
        }
        catch (\Throwable $th) {
            return $this->handleError('Error.', ['error'=>'Unable to process your request']);
        }
    }

}
