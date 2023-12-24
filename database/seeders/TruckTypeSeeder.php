<?php

namespace Database\Seeders;

use App\Models\TruckType;
use Illuminate\Database\Seeder;

class TruckTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TruckType::insert(['name' => 'মিনি পিকআপ']);
        TruckType::insert(['name' => 'খোলা পিকআপ']);
        TruckType::insert(['name' => 'কাভার্ড পিকআপ']);
        TruckType::insert(['name' => 'খোলা ট্রাক']);
        TruckType::insert(['name' => 'কাভার্ড ট্রাক']);
        TruckType::insert(['name' => 'ডাম্পার ট্রাক']);
        TruckType::insert(['name' => 'বেড ট্রেইলের']);
    }
}
