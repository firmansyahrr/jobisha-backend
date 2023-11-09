<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use App\Models\Master\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['code' => 'INA', 'name' => 'Indonesia'],
        ]);

        $lists->map(function ($list) {
            Country::firstOrCreate(
                [
                    'code' => $list['code'],
                ],
                $list
            );
        });
    }
}
