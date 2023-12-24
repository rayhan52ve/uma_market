<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }


    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bids()
    {
        return $this->hasMany(Bidding::class, 'trip_id', 'id');
    }

    public function truck()
    {
        return $this->hasOne(TruckType::class, 'id', 'truck_type');
    }
}
