<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use App\Models\Master\Country;
use App\Models\Master\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Country::where('code', 'INA')->first();

        $lists = collect([
            ['country_id' => $country->id, 'name' => 'ACEH'],
            ['country_id' => $country->id, 'name' => 'SUMATERA UTARA'],
            ['country_id' => $country->id, 'name' => 'SUMATERA BARAT'],
            ['country_id' => $country->id, 'name' => 'RIAU'],
            ['country_id' => $country->id, 'name' => 'JAMBI'],
            ['country_id' => $country->id, 'name' => 'SUMATERA SELATAN'],
            ['country_id' => $country->id, 'name' => 'BENGKULU'],
            ['country_id' => $country->id, 'name' => 'LAMPUNG'],
            ['country_id' => $country->id, 'name' => 'KEPULAUAN BANGKA BELITUNG'],
            ['country_id' => $country->id, 'name' => 'KEPULAUAN RIAU'],
            ['country_id' => $country->id, 'name' => 'DAERAH KHUSUS IBUKOTA JAKARTA'],
            ['country_id' => $country->id, 'name' => 'JAWA BARAT'],
            ['country_id' => $country->id, 'name' => 'JAWA TENGAH'],
            ['country_id' => $country->id, 'name' => 'DAERAH ISTIMEWA YOGYAKARTA'],
            ['country_id' => $country->id, 'name' => 'JAWA TIMUR'],
            ['country_id' => $country->id, 'name' => 'BANTEN'],
            ['country_id' => $country->id, 'name' => 'BALI'],
            ['country_id' => $country->id, 'name' => 'NUSA TENGGARA BARAT'],
            ['country_id' => $country->id, 'name' => 'NUSA TENGGARA TIMUR'],
            ['country_id' => $country->id, 'name' => 'KALIMANTAN BARAT'],
            ['country_id' => $country->id, 'name' => 'KALIMANTAN TENGAH'],
            ['country_id' => $country->id, 'name' => 'KALIMANTAN SELATAN'],
            ['country_id' => $country->id, 'name' => 'KALIMANTAN TIMUR'],
            ['country_id' => $country->id, 'name' => 'KALIMANTAN UTARA'],
            ['country_id' => $country->id, 'name' => 'SULAWESI UTARA'],
            ['country_id' => $country->id, 'name' => 'SULAWESI TENGAH'],
            ['country_id' => $country->id, 'name' => 'SULAWESI SELATAN'],
            ['country_id' => $country->id, 'name' => 'SULAWESI TENGGARA'],
            ['country_id' => $country->id, 'name' => 'GORONTALO'],
            ['country_id' => $country->id, 'name' => 'SULAWESI BARAT'],
            ['country_id' => $country->id, 'name' => 'MALUKU'],
            ['country_id' => $country->id, 'name' => 'MALUKU UTARA'],
            ['country_id' => $country->id, 'name' => 'PAPUA'],
            ['country_id' => $country->id, 'name' => 'PAPUA BARAT'],
        ]);

        $lists->map(function ($list) {
            Province::firstOrCreate(
                [
                    'country_id' => $list['country_id'],
                    'name' => $list['name'],
                ],
                $list
            );
        });
    }
}
