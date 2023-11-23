<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use Illuminate\Database\Seeder;

class AppParamGender extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['type' => 'genders', 'code' => 'gender_1', 'label' => 'Male',],
            ['type' => 'genders', 'code' => 'gender_2', 'label' => 'Female',],
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
