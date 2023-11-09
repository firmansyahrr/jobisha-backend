<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use App\Models\Master\City;
use App\Models\Master\Country;
use App\Models\Master\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MasterCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Country::where('code', 'INA')->first();

        $lists = collect([
            ['country_id' => $country->id, 'province_id' => 'DAERAH KHUSUS IBUKOTA JAKARTA', 'name' => 'JAKARTA PUSAT'],
            ['country_id' => $country->id, 'province_id' => 'DAERAH KHUSUS IBUKOTA JAKARTA', 'name' => 'JAKARTA TIMUR'],
            ['country_id' => $country->id, 'province_id' => 'DAERAH KHUSUS IBUKOTA JAKARTA', 'name' => 'JAKARTA BARAT'],
            ['country_id' => $country->id, 'province_id' => 'DAERAH KHUSUS IBUKOTA JAKARTA', 'name' => 'JAKARTA SELATAN'],
            ['country_id' => $country->id, 'province_id' => 'DAERAH KHUSUS IBUKOTA JAKARTA', 'name' => 'JAKARTA UTARA'],
        ]);

        $lists->map(function ($list) {
            $province = Province::where('name', $list['province_id'])->first();

            $list['province_id'] = $province->id;

            City::firstOrCreate(
                [
                    'country_id' => $list['country_id'],
                    'province_id' => $list['province_id'],
                    'name' => $list['name'],
                ],
                $list
            );
        });
    }
}
