<?php

namespace Database\Seeders;

use App\Models\Job\Job;
use App\Models\Job\JobPreference;
use App\Models\Job\JobRole;
use App\Models\Job\JobSpecialization;
use App\Models\Master\ApplicationParameter;
use Illuminate\Database\Seeder;

class JobPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = Job::all();
        $preferences = ApplicationParameter::where('type', 'work_preferences')->get();
    
        $max = ($preferences->count() - 1);
        
        $jobs->map(function ($job) use ($preferences, $max) {
        
            $randomNumber = random_int(0,$max);
            $preference = $preferences[$randomNumber];

            JobPreference::firstOrCreate(
                [
                    'job_id' => $job->id,
                    'preference_id' => $preference->id,
                ],
                [
                    'job_id' => $job->id,
                    'preference_id' => $preference->id,
                ]
            );
        });
    }
}
