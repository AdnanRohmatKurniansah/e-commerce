<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $daftarProvinsi = RajaOngkir::provinsi()->all();
        // foreach ($daftarProvinsi as $provinsiRow) {
        //     Province::create([
        //         'province_id' => $provinsiRow['province_id'],
        //         'title' => $provinsiRow['province']
        //     ]);
        //     $daftarKota = RajaOngkir::kota()->dariProvinsi($provinsiRow['province_id'])->get();
        //     foreach ($daftarKota as $cityRow) {
        //         City::create([
        //             'province_id' => $provinsiRow['province_id'],
        //             'city_id' => $cityRow['city_id'],
        //             'title' => $cityRow['city_name']
        //         ]);
        //     }
        // }
    }
}
