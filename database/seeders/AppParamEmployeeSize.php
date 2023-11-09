<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppParamEmployeeSize extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['type' => 'employee_size', 'code' => 'cs_size_1', 'label' => '1 - 50 Employees',],
            ['type' => 'employee_size', 'code' => 'cs_size_2', 'label' => '51 - 200 Employees',],
            ['type' => 'employee_size', 'code' => 'cs_size_3', 'label' => '201 - 500 Employees',],
            ['type' => 'employee_size', 'code' => 'cs_size_4', 'label' => '501 - 1000 Employees',],
            ['type' => 'employee_size', 'code' => 'cs_size_5', 'label' => '1001 - 2000 Employees',],
            ['type' => 'employee_size', 'code' => 'cs_size_6', 'label' => '2001 - 5000 Employees',],
            ['type' => 'employee_size', 'code' => 'cs_size_7', 'label' => 'More than 5000',],
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
