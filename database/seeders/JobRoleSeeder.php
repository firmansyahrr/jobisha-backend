<?php

namespace Database\Seeders;

use App\Models\Job\JobRole;
use App\Models\Job\JobSpecialization;
use Illuminate\Database\Seeder;

class JobRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobSpecialization = JobSpecialization::where('code', 'software_engineer')->first();

        $lists = collect([
            ['job_specialization_id' => $jobSpecialization->id, 'code' => 'fullstack_developer', 'label' => 'Fullstack Developer'],
            ['job_specialization_id' => $jobSpecialization->id, 'code' => 'frontend_developer', 'label' => 'Frontend Developer'],
            ['job_specialization_id' => $jobSpecialization->id, 'code' => 'backend_developer', 'label' => 'Backend Developer'],
        ]);

        $lists->map(function ($list) {
            JobRole::firstOrCreate(
                [
                    'job_specialization_id' => $list['job_specialization_id'],
                    'code' => $list['code'],
                ],
                $list
            );
        });
    }
}
