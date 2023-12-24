<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_code',
        'coupon_type',
        'redeem_amount',
        'number_of_uses',
        'number_of_uses_per_users',
        'expired_at',
    ];

}
