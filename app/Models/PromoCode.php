<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = ['promo_code', 'country', 'city', 'pick_up_address', 'drop_off_address', 'start_date', 'end_date'];
}
