<?php

namespace Database\Seeders;

use App\Models\Job\JobSpecialization;
use Illuminate\Database\Seeder;

class JobSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = collect([
            ['code' => 'software_engineer', 'label' => 'Software Engineer'],
        ]);

        $lists->map(function ($list) {
            JobSpecialization::firstOrCreate(
                [
                    'code' => $list['code'],
                ],
                $list
            );
        });
    }
}
