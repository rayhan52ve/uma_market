<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_id',
        'user_id',
        'trip_id',
    ];


     // Define the relationships
     public function coupon()
     {
         return $this->belongsTo(Coupon::class, 'coupon_id');
     }

     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }

     public function trip()
     {
         return $this->belongsTo(TripInfo::class, 'trip_id');
     }
}
