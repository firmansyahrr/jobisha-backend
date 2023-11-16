<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use Illuminate\Database\Seeder;

class AppParamRangeSalary extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['type' => 'salary_range', 'code' => 'range_1', 'label' => 'IDR 0 - IDR 3.000.000',],
            ['type' => 'salary_range', 'code' => 'range_2', 'label' => 'IDR 3.000.001 - IDR 5.000.000',],
            ['type' => 'salary_range', 'code' => 'range_3', 'label' => 'IDR 5.000.001 - IDR 10.000.000',],
            ['type' => 'salary_range', 'code' => 'range_4', 'label' => 'IDR 10.000.001 - IDR 15.000.000',],
            ['type' => 'salary_range', 'code' => 'range_5', 'label' => 'IDR 15.000.001 - IDR 20.000.000',],
            ['type' => 'salary_range', 'code' => 'range_6', 'label' => 'IDR 20.000.001 - IDR 25.000.000',],
            ['type' => 'salary_range', 'code' => 'range_7', 'label' => '>= IDR 20.000.001',],
        ]);

        $lists->map(function ($list) {
            ApplicationParameter::firstOrCreate(
                [
                    'type' => $list['type'],
                    'code' => $list['code'],
                ],
                $list
            );
        });
    }
}
