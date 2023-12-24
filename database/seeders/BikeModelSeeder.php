<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BikeModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bikeModels = [
            [
                'name' => 'Yamaha R15 V4',
                'engine_displacement' => 155,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha R15 v3 Indian',
                'engine_displacement' => 155,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha R15 v3 Monster',
                'engine_displacement' => 155,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha R15 v3 Indonesian',
                'engine_displacement' => 155,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha XSR 155',
                'engine_displacement' => 155,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha MT 15',
                'engine_displacement' => 155,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha FZ-X',
                'engine_displacement' => 155,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha M-Slaz 150',
                'engine_displacement' => 150,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha Vixion 150',
                'engine_displacement' => 149,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha XTZ 150',
                'engine_displacement' => 149.3,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha FZS Fi v3 ABS',
                'engine_displacement' => 149,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha Fazer FI v2.0',
                'engine_displacement' => 149,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha FZS FI v2.0',
                'engine_displacement' => 149,
                'brand_id' => '1',
            ],
            [
                'name' => 'Yamaha Saluto 125',
                'engine_displacement' => 125,
                'brand_id' => '1',
            ],
            // suzuki
            [
                'name' => 'Suzuki GSX R150 ABS',
                'engine_displacement' => 147.3,
                'brand_id' => '3',
            ],
            [
                'name' => 'Suzuki GSX S150',
                'engine_displacement' => 147.3,
                'brand_id' => '3',
            ],
            [
                'name' => 'Suzuki Bandit 150',
                'engine_displacement' => 147.3,
                'brand_id' => '3',
            ],
            [
                'name' => 'New Gixxer SF 150 ABS',
                'engine_displacement' => 155,
                'brand_id' => '3',
            ],
            [
                'name' => 'Suzuki Intruder 150 ABS',
                'engine_displacement' => 155,
                'brand_id' => '3',
            ],
            [
                'name' => 'Gixxer SF 150 (old edition)',
                'engine_displacement' => 155,
                'brand_id' => '3',
            ],
            [
                'name' => 'Gixxer 150 (New Edition)',
                'engine_displacement' => 155,
                'brand_id' => '3',
            ],
            [
                'name' => 'Suzuki Gixxer Dual Tone',
                'engine_displacement' => 155,
                'brand_id' => '3',
            ],
            [
                'name' => 'Suzuki Gixxer Mono Tone',
                'engine_displacement' => 155,
                'brand_id' => '3',
            ],
            [
                'name' => 'Suzuki Samurai 150',
                'engine_displacement' => 149,
                'brand_id' => '3',
            ],
            [
                'name' => 'Suzuki GSX 125',
                'engine_displacement' => 125,
                'brand_id' => '3',
            ],
            [
                'name' => 'Suzuki Hayate Special',
                'engine_displacement' => 125,
                'brand_id' => '3',
            ],
            //tvs
            [
                'name' => 'TVS Apache RTR 160 4V ABS',
                'engine_displacement' => 159.7,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Apache RTR 160 4V DD',
                'engine_displacement' => 159.7,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Apache RTR 160 4V SD',
                'engine_displacement' => 157.7,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Apache RTR 160 DD',
                'engine_displacement' => 159.7,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Rider 125',
                'engine_displacement' => 125,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Max Semi Trail 125',
                'engine_displacement' => 125,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Max 125',
                'engine_displacement' => 124.5,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Stryker 125',
                'engine_displacement' => 124.5,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Metro Plus (Disc)',
                'engine_displacement' => 109.7,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Metro Plus (Drum)',
                'engine_displacement' => 109.7,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Radeon',
                'engine_displacement' => 109.7,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Metro ES',
                'engine_displacement' => 99.7,
                'brand_id' => '5',
            ],
            [
                'name' => 'TVS Metro KS',
                'engine_displacement' => 99.7,
                'brand_id' => '5',
            ],
            //Honda
            [
                'name' => 'New Honda CBR150R (ABS)',
                'engine_displacement' => 149.2,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda CBR150R MotoGP (Repsol)',
                'engine_displacement' => 149.2,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda CBR150R Indonesian',
                'engine_displacement' => 149.2,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda CB 150R ExMotion (ABS)',
                'engine_displacement' => 149.0,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda CB150R StreetFire',
                'engine_displacement' => 149.2,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda CB Hornet 160R ABS',
                'engine_displacement' => 162.7,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda CB Hornet 160R',
                'engine_displacement' => 162.7,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda CRF 150L',
                'engine_displacement' => 149.0,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda X-Blade 160',
                'engine_displacement' => 162.7,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda CB Shine SP',
                'engine_displacement' => 124.7,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda Livo',
                'engine_displacement' => 109.5,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda Dream Neo',
                'engine_displacement' => 109.5,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda Dio',
                'engine_displacement' => 109.5,
                'brand_id' => '2',
            ],
            [
                'name' => 'Honda Vario 125',
                'engine_displacement' => 125.0,
                'brand_id' => '2',
            ],
            //Hero
            [
                'name' => 'Hero Thriller 160R ABS',
                'engine_displacement' => 163.0,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Thriller 160R DD',
                'engine_displacement' => 163.0,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Hunk 150R ABS',
                'engine_displacement' => 149.2,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Hunk 150R DD',
                'engine_displacement' => 149.2,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Hunk Matt Finishing',
                'engine_displacement' => 149.2,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Hunk Glossy Finishing',
                'engine_displacement' => 149.2,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Achiever',
                'engine_displacement' => 149.2,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Passion Xpro Xtec',
                'engine_displacement' => 110.0,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Ignitor 125 (Techno)',
                'engine_displacement' => 124.7,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Glamour',
                'engine_displacement' => 124.7,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Passion Xpro',
                'engine_displacement' => 109.2,
                'brand_id' => '4',
            ],
            [
                'name' => 'Splendor iSmart Plus',
                'engine_displacement' => 113.2,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Super Splendor',
                'engine_displacement' => 124.7,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Splendor Plus IBS',
                'engine_displacement' => 97.2,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero Splendor Plus (ES)',
                'engine_displacement' => 97.2,
                'brand_id' => '4',
            ],
            [
                'name' => 'Hero HF Deluxe (ES)',
                'engine_displacement' => 97.2,
                'brand_id' => '4',
            ],
            //Runner
            [
                'name' => 'Runner Bolt 165R',
                'engine_displacement' => 165.0,
                'brand_id' => '10',
            ],
            [
                'name' => 'Runner Knight Rider 150 V2',
                'engine_displacement' => 150.0,
                'brand_id' => '10',
            ],
            [
                'name' => 'Runner Knight Rider 150',
                'engine_displacement' => 150.0,
                'brand_id' => '10',
            ],
            [
                'name' => 'Runner Turbo 125',
                'engine_displacement' => 125.0,
                'brand_id' => '10',
            ],
            [
                'name' => 'Runner Bullet 100 V2',
                'engine_displacement' => 100.0,
                'brand_id' => '10',
            ],
            [
                'name' => 'Runner F100-6A',
                'engine_displacement' => 100.0,
                'brand_id' => '10',
            ],
            [
                'name' => 'Runner AD-80S Deluxe',
                'engine_displacement' => 85.0,
                'brand_id' => '10',
            ],
            [
                'name' => 'Runner Bike RT',
                'engine_displacement' => 86.0,
                'brand_id' => '10',
            ],
            [
                'name' => 'Runner AD-80S Alloy',
                'engine_displacement' => 80.0,
                'brand_id' => '10',
            ],
            // Runner Scooters
            [
                'name' => 'Runner Skooty 110',
                'engine_displacement' => 104.0,
                'brand_id' => '10',
            ],
            [
                'name' => 'Scooter Runner Kite Plus',
                'engine_displacement' => 110.0,
                'brand_id' => '10',
            ],
            // Lifan Motorcycles
            [
                'name' => 'Lifan KPT 150 ABS',
                'engine_displacement' => 150.0,
                'brand_id' => '7',
            ],
            [
                'name' => 'Lifan K19',
                'engine_displacement' => 165.0,
                'brand_id' => '7',
            ],
            [
                'name' => 'Lifan KPR 165 (EFI)',
                'engine_displacement' => 165.0,
                'brand_id' => '7',
            ],
            [
                'name' => 'Lifan KPR 150',
                'engine_displacement' => 150.0,
                'brand_id' => '7',
            ],
            [
                'name' => 'Lifan X-Pect 150',
                'engine_displacement' => 150.0,
                'brand_id' => '7',
            ],
            [
                'name' => 'Lifan KPS 150',
                'engine_displacement' => 150.0,
                'brand_id' => '7',
            ],
            [
                'name' => 'Lifan KP Mini 150',
                'engine_displacement' => 150.0,
                'brand_id' => '7',
            ],
            [
                'name' => 'Scooter Lifan Blink 125',
                'engine_displacement' => 125.0,
                'brand_id' => '7',
            ],
            [
                'name' => 'Lifan Glint 100',
                'engine_displacement' => 100.0,
                'brand_id' => '7',
            ],
            [
                'name' => 'Lifan KP 150 V2',
                'engine_displacement' => 150.0,
                'brand_id' => '7',
            ],
            [
                'name' => 'Scooter Lifan KPV 150',
                'engine_displacement' => 150.0,
                'brand_id' => '7',
            ],

            // Walton Motorcycles
            [
                'name' => 'Walton Xplore 125',
                'engine_displacement' => 125.0,
                'brand_id' => '25',
            ],
            [
                'name' => 'Walton Fusion 110 Ex',
                'engine_displacement' => 110.0,
                'brand_id' => '25',
            ],
            [
                'name' => 'Walton Cruize 100',
                'engine_displacement' => 100.0,
                'brand_id' => '25',
            ],
            [
                'name' => 'Walton Prizm 110',
                'engine_displacement' => 110.0,
                'brand_id' => '25',
            ],
            [
                'name' => 'Walton Ranger',
                'engine_displacement' => 100.0,
                'brand_id' => '25',
            ],
            [
                'name' => 'Walton Stylex Plus',
                'engine_displacement' => 100.0,
                'brand_id' => '25',
            ],
            [
                'name' => 'Walton Xplore 140',
                'engine_displacement' => 140.0,
                'brand_id' => '25',
            ],
            [
                'name' => 'Walton Fusion 125 NX',
                'engine_displacement' => 125.0,
                'brand_id' => '25',
            ],

            // Bajaj Motorcycles
            [
                'name' => 'Bajaj Pulsar N160',
                'engine_displacement' => 164.8,
                'brand_id' => '6',
            ],
            [
                'name' => 'Bajaj Pulsar NS160 Fi ABS',
                'engine_displacement' => 160.3,
                'brand_id' => '6',
            ],
            [
                'name' => 'Bajaj Pulsar 150 ABS',
                'engine_displacement' => 149.5,
                'brand_id' => '6',
            ],
            [
                'name' => 'Pulsar 150 Twin Disc',
                'engine_displacement' => 149.5,
                'brand_id' => '6',
            ],
            [
                'name' => 'Bajaj Pulsar Neon 150',
                'engine_displacement' => 149.5,
                'brand_id' => '6',
            ],
            [
                'name' => 'Bajaj Avenger Street 160',
                'engine_displacement' => 160.0,
                'brand_id' => '6',
            ],
            [
                'name' => 'Bajaj Pulsar NS 125',
                'engine_displacement' => 124.5,
                'brand_id' => '6',
            ],
            [
                'name' => 'Bajaj Discover 125',
                'engine_displacement' => 124.6,
                'brand_id' => '6',
            ],
            [
                'name' => 'Bajaj Discover 110',
                'engine_displacement' => 115.5,
                'brand_id' => '6',
            ],
            [
                'name' => 'Bajaj Platina 110 H Gear',
                'engine_displacement' => 115.5,
                'brand_id' => '6',
            ],
            [
                'name' => 'Bajaj Platina 100 ES',
                'engine_displacement' => 99.3,
                'brand_id' => '6',
            ],
            [
                'name' => 'Bajaj CT 100 ES',
                'engine_displacement' => 99.3,
                'brand_id' => '6',
            ],
            // KTM Motorcycles
            [
                'name' => 'KTM 125 Duke (European)',
                'engine_displacement' => 124.7,
                'brand_id' => '11',
            ],
            [
                'name' => 'KTM RC 125 (European)',
                'engine_displacement' => 124.7,
                'brand_id' => '11',
            ],
            [
                'name' => 'KTM 125 Duke (Indian)',
                'engine_displacement' => 124.7,
                'brand_id' => '11',
            ],
            [
                'name' => 'KTM RC 125 (Indian)',
                'engine_displacement' => 124.7,
                'brand_id' => '11',
            ],

            // Mahindra Motorcycles
            [
                'name' => 'Mahindra Centuro N1',
                'engine_displacement' => 107.0,
                'brand_id' => '24',
            ],
            [
                'name' => 'Mahindra Centuro Disc',
                'engine_displacement' => 107.0,
                'brand_id' => '24',
            ],
            [
                'name' => 'Mahindra Centuro NXT',
                'engine_displacement' => 107.0,
                'brand_id' => '24',
            ],
            [
                'name' => 'Mahindra Centuro Rockstar DLX',
                'engine_displacement' => 107.0,
                'brand_id' => '24',
            ],
            [
                'name' => 'Mahindra Centuro Rockstar',
                'engine_displacement' => 107.0,
                'brand_id' => '24',
            ],
            [
                'name' => 'Mahindra Pentero',
                'engine_displacement' => 107.0,
                'brand_id' => '24',
            ],
            [
                'name' => 'Mahindra Arro XT',
                'engine_displacement' => 107.0,
                'brand_id' => '24',
            ],

            // Mahindra Scooters
            [
                'name' => 'Scooter Mahindra Gusto 110 VX',
                'engine_displacement' => 110.0,
                'brand_id' => '24',
            ],
            [
                'name' => 'Scooter Mahindra Rodeo RZ',
                'engine_displacement' => 125.0,
                'brand_id' => '24',
            ],
            [
                'name' => 'Scooter Mahindra Duro DZ',
                'engine_displacement' => 125.0,
                'brand_id' => '24',
            ],
            [
                'name' => 'Scooter Mahindra Gusto 125',
                'engine_displacement' => 125.0,
                'brand_id' => '24',
            ],
            // Zontes Motorcycles
            [
                'name' => 'Zontes ZT155 G1',
                'engine_displacement' => 155.0,
                'brand_id' => '8',
            ],
            [
                'name' => 'Zontes ZT155 GK',
                'engine_displacement' => 155.0,
                'brand_id' => '8',
            ],
            [
                'name' => 'Zontes ZT155 U',
                'engine_displacement' => 155.0,
                'brand_id' => '8',
            ],
            [
                'name' => 'Zontes ZT155 U1',
                'engine_displacement' => 155.0,
                'brand_id' => '8',
            ],

            // Haojue Motorcycles
            [
                'name' => 'Haojue DR 160',
                'engine_displacement' => 162.0,
                'brand_id' => '9',
            ],
            [
                'name' => 'Haojue TR 150',
                'engine_displacement' => 150.0,
                'brand_id' => '9',
            ],
            [
                'name' => 'Haojue TZ 135',
                'engine_displacement' => 135.0,
                'brand_id' => '9',
            ],
            [
                'name' => 'Haojue KA 135',
                'engine_displacement' => 135.0,
                'brand_id' => '9',
            ],
            [
                'name' => 'Haojue Cool 150',
                'engine_displacement' => 150.0,
                'brand_id' => '9',
            ],
            [
                'name' => 'Scooter Haojue Lindy',
                'engine_displacement' => 125.0,
                'brand_id' => '9',
            ],

            // Aprilia Motorcycles
            [
                'name' => 'Aprilia GPR 150',
                'engine_displacement' => 149.2,
                'brand_id' => '12',
            ],
            [
                'name' => 'Aprilia Cafe 150',
                'engine_displacement' => 149.2,
                'brand_id' => '12',
            ],
            [
                'name' => 'Aprilia Terra 150',
                'engine_displacement' => 150.0,
                'brand_id' => '12',
            ],
            [
                'name' => 'Scooter Aprilia SR 150 Race ABS',
                'engine_displacement' => 150.0,
                'brand_id' => '12',
            ],
            [
                'name' => 'Scooter Aprilia SR 150',
                'engine_displacement' => 155.0,
                'brand_id' => '12',
            ],
            [
                'name' => 'Scooter Aprilia SR 125',
                'engine_displacement' => 125.0,
                'brand_id' => '12',
            ],

            // Kawasaki Motorcycles
            [
                'name' => 'Kawasaki Ninja 125 ABS',
                'engine_displacement' => 125.0,
                'brand_id' => '13',
            ],
            [
                'name' => 'Kawasaki Z125 ABS',
                'engine_displacement' => 125.0,
                'brand_id' => '13',
            ],
            [
                'name' => 'Kawasaki D-Tracker',
                'engine_displacement' => 144.0,
                'brand_id' => '13',
            ],
            [
                'name' => 'Kawasaki KLX 150 BF',
                'engine_displacement' => 144.0,
                'brand_id' => '13',
            ],
            [
                'name' => 'Kawasaki KLX 150 L',
                'engine_displacement' => 144.0,
                'brand_id' => '13',
            ],
            [
                'name' => 'Kawasaki Z125 Pro',
                'engine_displacement' => 125.0,
                'brand_id' => '13',
            ],
            [
                'name' => 'Kawasaki KSR Pro',
                'engine_displacement' => 110.0,
                'brand_id' => '13',
            ],

            // Benelli Motorcycles
            [
                'name' => 'Benelli 165S',
                'engine_displacement' => 160.0,
                'brand_id' => '14',
            ],
            [
                'name' => 'Benelli TNT 135',
                'engine_displacement' => 135.0,
                'brand_id' => '14',
            ],
            [
                'name' => 'Benelli TNT 150',
                'engine_displacement' => 150.0,
                'brand_id' => '14',
            ],

            // Taro Motorcycles
            [
                'name' => 'Taro GP-One Special Edition',
                'engine_displacement' => 150.0,
                'brand_id' => '16',
            ],
            [
                'name' => 'Taro GP One Naked Sport',
                'engine_displacement' => 150.0,
                'brand_id' => '16',
            ],
            [
                'name' => 'Taro GP One',
                'engine_displacement' => 150.0,
                'brand_id' => '16',
            ],
            [
                'name' => 'Taro GP Two',
                'engine_displacement' => 150.0,
                'brand_id' => '16',
            ],
            [
                'name' => 'Taro F16 CT Max',
                'engine_displacement' => 125.0,
                'brand_id' => '16',
            ],

            // Vespa Scooters
            [
                'name' => 'Vespa VXL 150 (Yellow)',
                'engine_displacement' => 150.0,
                'brand_id' => '17',
            ],
            [
                'name' => 'Vespa SXL 150',
                'engine_displacement' => 150.0,
                'brand_id' => '17',
            ],
            [
                'name' => 'Vespa Elegante 150',
                'engine_displacement' => 150.0,
                'brand_id' => '17',
            ],
            // Vespa Scooters
            [
                'name' => 'Vespa VXL 125',
                'engine_displacement' => 125.0,
                'brand_id' => '17',
            ],
            [
                'name' => 'Vespa Notte 125',
                'engine_displacement' => 125.0,
                'brand_id' => '17',
            ],
            [
                'name' => 'Vespa LX 125',
                'engine_displacement' => 125.0,
                'brand_id' => '17',
            ],

            // RoadMaster Motorcycles
            [
                'name' => 'RoadMaster Rapido 150',
                'engine_displacement' => 150.0,
                'brand_id' => '18',
            ],
            [
                'name' => 'RoadMaster Rapido 165',
                'engine_displacement' => 165.0,
                'brand_id' => '18',
            ],
            [
                'name' => 'Roadmaster Velocity',
                'engine_displacement' => 100.0,
                'brand_id' => '18',
            ],
            [
                'name' => 'Roadmaster Delight',
                'engine_displacement' => 100.0,
                'brand_id' => '18',
            ],
            [
                'name' => 'Roadmaster Prime',
                'engine_displacement' => 85.0,
                'brand_id' => '18',
            ],
            [
                'name' => 'Roadmaster Prime 100',
                'engine_displacement' => 100.0,
                'brand_id' => '18',
            ],

            // // Loncin Motorcycles
            // [
            //     'name' => 'Loncin GP 150',
            //     'engine_displacement' => 150.0,
            //     'brand_id' => 'LONCIN',
            // ],
            // [
            //     'name' => 'CFMoto 150 NK',
            //     'engine_displacement' => 150.0,
            //     'brand_id' => 'CFMOTO',
            // ],
            // [
            //     'name' => 'Loncin GP 165',
            //     'engine_displacement' => 165.0,
            //     'brand_id' => 'LONCIN',
            // ],
            [
                'name' => 'H Power CRZ 165',
                'engine_displacement' => 165.0,
                'brand_id' => '19',
            ],
            [
                'name' => 'H Power RoxR',
                'engine_displacement' => 150.0,
                'brand_id' => '19',
            ],
            [
                'name' => 'H Power Max-Z',
                'engine_displacement' => 155.0,
                'brand_id' => '19',
            ],
            [
                'name' => 'H Power Recover',
                'engine_displacement' => 100.0,
                'brand_id' => '19',
            ],
            [
                'name' => 'H Power RS-Z',
                'engine_displacement' => 150.0,
                'brand_id' => '19',
            ],
            [
                'name' => 'H Power Star 100',
                'engine_displacement' => 150.0,
                'brand_id' => '19',
            ],
            [
                'name' => 'H Power Star 80',
                'engine_displacement' => 80.0,
                'brand_id' => '19',
            ],
            // [
            //     'name' => 'Zaara 100',
            //     'engine_displacement' => 100.0,
            //     'brand_id' => 'ZAARA',
            // ],
            // [
            //     'name' => 'Zaara 110 Digital',
            //     'engine_displacement' => 100.0,
            //     'brand_id' => 'ZAARA',
            // ],
            // [
            //     'name' => 'Zaara DD 80',
            //     'engine_displacement' => 80.0,
            //     'brand_id' => 'ZAARA',
            // ],
            // [
            //     'name' => 'Scooter Zaara Cherry (electric)',
            //     'engine_displacement' => 80.0,
            //     'brand_id' => 'ZAARA',
            // ],

            // Speeder Motorcycles
            [
                'name' => 'Speeder NSX 165R',
                'engine_displacement' => 165.0,
                'brand_id' => '20',
            ],
            [
                'name' => 'Speeder Countryman',
                'engine_displacement' => 165.0,
                'brand_id' => '20',
            ],
            [
                'name' => 'Speeder Countryman (DD)',
                'engine_displacement' => 165.0,
                'brand_id' => '20',
            ],
            [
                'name' => 'Speeder Big Monster 165 Fi (DD)',
                'engine_displacement' => 165.0,
                'brand_id' => '20',
            ],
            [
                'name' => 'Speeder Colt 150 (SD)',
                'engine_displacement' => 155.0,
                'brand_id' => '20',
            ],
            [
                'name' => 'Speeder Vigo 110 (SD)',
                'engine_displacement' => 110.0,
                'brand_id' => '20',
            ],
            [
                'name' => 'Speeder Republic 100',
                'engine_displacement' => 100.0,
                'brand_id' => '20',
            ],
            // FKM Motorcycles
            [
                'name' => 'FKM Street Fighter 165 SF',
                'engine_displacement' => 165.0,
                'brand_id' => '21',
            ],
            [
                'name' => 'FKM Street Scrambler 165 SX',
                'engine_displacement' => 165.0,
                'brand_id' => '21',
            ],
            [
                'name' => 'FKM Mini Scrambler 150 MS',
                'engine_displacement' => 150.0,
                'brand_id' => '21',
            ],

            // GPX Motorcycles
            [
                'name' => 'GPX Demon GR165RR',
                'engine_displacement' => 165.0,
                'brand_id' =>'22',
            ],
            [
                'name' => 'GPX Demon GR165 R',
                'engine_displacement' => 165.0,
                'brand_id' =>'22',
            ],

        ];

        foreach ($bikeModels as $modelData) {
            DB::table('bike_models')->insert([
                'name' => $modelData['name'],
                'engine_displacement' => $modelData['engine_displacement'],
                'brand_id' => $modelData['brand_id'],
                // 'website' => $brandData['website'],
            ]);
        }
    }
}
