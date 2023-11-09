<?php

namespace Database\Seeders;

use App\Models\Master\ApplicationParameter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppParamJobPreference extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['type' => 'work_preference', 'code' => 'wp_onsite', 'label' => 'Onsite',],
            ['type' => 'work_preference', 'code' => 'wp_hybrid', 'label' => 'Hybrid',],
            ['type' => 'work_preference', 'code' => 'wp_remote', 'label' => 'Remote',],
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
