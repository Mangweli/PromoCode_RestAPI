<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PromoCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id"                       => $this->id,
            "promo_code"               => $this->promo_code,
            "country"                  => $this->country,
            "city"                     => $this->city,
            "amount"                   => $this->amount,
            "number_of_usage_per_rider"=> $this->number_of_usage_per_rider,
            "max_total_amount"         => $this->max_total_amount,
            "current_usage"            => $this->current_usage,
            "start_date"               => $this->start_date,
            "end_date"                 => $this->end_date,
            "disabled"                 => $this->disabled,
            "gender"                   => $this->gendernull,
            "pick_up_address"          => $this->pick_up_address,
            "pick_up_ll"               => $this->pick_up_ll,
            "pick_up_variance"         => $this->pick_up_variance,
            "drop_off_address"         => $this->drop_off_address,
            "drop_off_ll"              => $this->drop_off_ll,
            "drop_off_variance"        => $this->drop_off_variance,
            "created_at"               => $this->created_at,
        ];
    }
}
