<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use Illuminate\Database\Seeder;

class AppParamSkillLevel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['type' => 'skill_levels', 'code' => 'skill_level_1', 'label' => 'Beginner',],
            ['type' => 'skill_levels', 'code' => 'skill_level_2', 'label' => 'Amateur',],
            ['type' => 'skill_levels', 'code' => 'skill_level_3', 'label' => 'Pro',],
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
