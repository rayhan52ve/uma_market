<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BikeBrandSeeder extends Seeder
{
    public function run()
    {
        $bikeBrands = [
            'YAMAHA',
            'HONDA',
            'SUZUKI',
            'HERO',
            'TVS',
            'BAJAJ',
            'LIFAN',
            'ZONTES',
            'HAOJUE',
            'RUNNER',
            'KTM',
            'APRILIA',
            'KAWASAKI',
            'BENELLI',
            'KEEWAY',
            'TARO',
            'VESPA',
            'ROADMASTER',
            'H-POWER',
            'SPEEDER',
            'FKM',
            'GPX',
            'ZNEN',
            'MAHINDRA',
            'WALTON',
            // Add more brand names as needed
        ];

        foreach ($bikeBrands as $brandName) {
            DB::table('bike_brands')->insert([
                'name' => $brandName,
            ]);
        }
    }
}
