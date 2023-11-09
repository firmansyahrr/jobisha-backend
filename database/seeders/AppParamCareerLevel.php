<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use Illuminate\Database\Seeder;

class AppParamCareerLevel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['type' => 'career_level', 'code' => 'cl_level_1', 'label' => 'Staff (non-management & non-supervisor)',],
            ['type' => 'career_level', 'code' => 'cl_level_2', 'label' => 'Management',],
            ['type' => 'career_level', 'code' => 'cl_level_3', 'label' => 'Supervisor',],
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
