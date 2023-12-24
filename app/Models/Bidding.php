<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id', 'customer_id', 'provider_id', 'service_id', 'bid_amount', 'pay_status','status'];

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function customerMobile()
    {
        return $this->belongsTo(User::class, 'customer_id')->select('mobile');
    }

    public function trip()
    {
        return $this->belongsTo(TripInfo::class, 'trip_id', 'id');
    }
    public function trips()
    {
        return $this->belongsTo(TripInfo::class, 'trip_id', 'id')->where('status','in-progress');
    }

    public function scopeStatus($query)
    {
        return $query->where('status',2);
    }

}
