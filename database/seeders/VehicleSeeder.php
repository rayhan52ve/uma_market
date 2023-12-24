<?php

namespace Database\Seeders;

use App\Models\PassengerCount;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::insert(['name' => 'ট্রাক']);
        Vehicle::insert(['name' => 'প্রাইভেট কার']);
        Vehicle::insert(['name' => 'মাইক্রো']);
        Vehicle::insert(['name' => 'এম্বুল্যান্স']);
        Vehicle::insert(['name' => 'মোটরসাইকেল']);
        Vehicle::insert(['name' => 'সিএনজি']);
        Vehicle::insert(['name' => 'ভ্যান']);
        Vehicle::insert(['name' => 'মাহিন্দ্রা']);
        Vehicle::insert(['name' => 'ইজি বাইক']);
        Vehicle::insert(['name' => 'বাস']);
        PassengerCount::insert(['number' => '১ জন']);
        PassengerCount::insert(['number' => '২ জন']);
        PassengerCount::insert(['number' => '৩ জন']);
        PassengerCount::insert(['number' => '৪ জন']);
        PassengerCount::insert(['number' => '৫ জন']);
        PassengerCount::insert(['number' => '৬ জন']);
        PassengerCount::insert(['number' => '৭ জন']);
        PassengerCount::insert(['number' => '৮ জন']);
        PassengerCount::insert(['number' => '৯ জন']);
        PassengerCount::insert(['number' => '১০ জন']);
        PassengerCount::insert(['number' => '১১ জন']);
        PassengerCount::insert(['number' => '১২ জন']);
        PassengerCount::insert(['number' => '১৩ জন']);
        PassengerCount::insert(['number' => '১৫ হতে ২০ জন', 'is_bus' => 1]);
        PassengerCount::insert(['number' => '২০ হতে ৩০ জন', 'is_bus' => 1]);
        PassengerCount::insert(['number' => '৩০ হতে ৪০ জন', 'is_bus' => 1]);
        PassengerCount::insert(['number' => '৪০ হতে ৫০ জন', 'is_bus' => 1]);
    }
}
