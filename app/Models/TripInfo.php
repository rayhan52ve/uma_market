<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripInfo extends Model
{
    use HasFactory;


    protected $fillable = [

        'user_id',
        'vehicle_id',
        'bike_brand_id',
        'bike_model_id',
        'start_location',
        'end_location',
        'starting_date',
        'starting_time',
        'passenger_count',
        'trip_type',
        'ac_type',
        'duration_month',
        'duration_day',
        'duration_hour',
        'rent_description',
        'patient_type',
        'life_support_type',
        'ton',
        'feet',
        'truck_type',
        'product_description',
        'receiver_mobile',
        'second_load',
        'third_load',
        'second_load_location',
        'second_provider_mobile',
        'second_unload_location',
        'second_receiver_mobile',
        'third_load_location',
        'third_provider_mobile',
        'third_unload_location',
        'third_receiver_mobile',
        'product_tags',
        'without_driver',
        'customer_full_name',
        'customer_address',
        'customer_nid_no',
        'customer_nid_image_front',
        'customer_nid_image_back',
        'customer_driving_license_image_front',
        'customer_driving_license_image_back',
        'parent_name',
        'parent_mobile',
        'parent_nid_no',
        'parent_nid_image_front',
        'parent_nid_image_back',
        'status'
    ];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }


    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function provider()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bids()
    {
        return $this->hasMany(Bidding::class, 'trip_id', 'id');
    }

    public function bidding()
    {
        return $this->hasOne(Bidding::class, 'trip_id');
    }

    public function biddings()
    {
        return $this->hasMany(Bidding::class, 'trip_id');
    }
    
    public function truck()
    {
        return $this->hasOne(TruckType::class, 'id', 'truck_type');
    }

    public function scopeRunningOrder($query)
    {
        return $query->where('status', 'in-progress');
    }

    public function scopeConfirmOrder($query)
    {
        return $query->where('status', 'ordered');
    }

    public function scopeCancelOrder($query)
    {
        return $query->where('status', 'canceled');
    }

    public function bikeBrand()
    {
        return $this->belongsTo(BikeBrand::class, 'bike_brand_id');
    }


    public function bikeModel()
    {
        return $this->belongsTo(BikeModel::class, 'bike_model_id');
    }

}
