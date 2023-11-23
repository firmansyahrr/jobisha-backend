<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use Illuminate\Database\Seeder;

class AppParamEducationLevel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['type' => 'education_levels', 'code' => 'education_level_1', 'label' => 'Kindergaten School',],
            ['type' => 'education_levels', 'code' => 'education_level_2', 'label' => 'Elementry School',],
            ['type' => 'education_levels', 'code' => 'education_level_3', 'label' => 'Junior High School',],
            ['type' => 'education_levels', 'code' => 'education_level_4', 'label' => 'Vocational High School',],
            ['type' => 'education_levels', 'code' => 'education_level_5', 'label' => 'Senior High School',],
            ['type' => 'education_levels', 'code' => 'education_level_6', 'label' => 'Associate Degree',],
            ['type' => 'education_levels', 'code' => 'education_level_7', 'label' => 'Bachelor Degree',],
            ['type' => 'education_levels', 'code' => 'education_level_8', 'label' => 'Master Degree',],
            ['type' => 'education_levels', 'code' => 'education_level_9', 'label' => 'Doctoral Degree',],
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
