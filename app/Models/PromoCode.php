<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_code',
        'country',
        'city',
        'pick_up_address',
        'drop_off_address',
        'start_date',
        'end_date',
        'amount',
        'number_of_usage_per_rider',
        'max_total_amount',
        'pick_up_ll',
        'drop_off_ll',
        'pick_up_variance',
        'drop_off_variance'

    ];
}
