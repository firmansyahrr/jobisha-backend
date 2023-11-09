<?php

namespace Database\Seeders;

use App\Models\Job\Job;
use App\Models\Job\JobLocation;
use App\Models\Job\JobPreference;
use App\Models\Job\JobRole;
use App\Models\Job\JobSpecialization;
use App\Models\Master\ApplicationParameter;
use App\Models\Master\City;
use App\Models\Master\Province;
use Illuminate\Database\Seeder;

class JobLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = Job::all();

        $province = Province::where('name', 'DAERAH KHUSUS IBUKOTA JAKARTA')->first();
        $city = City::where('name', 'JAKARTA PUSAT')->first();

        $jobs->map(function ($job) use ($province, $city) {
            JobLocation::firstOrCreate(
                [
                    'job_id' => $job->id,
                    'province_id' => $province->id,
                    'city_id' => $city->id,
                ],
                [
                    'job_id' => $job->id,
                    'province_id' => $province->id,
                    'city_id' => $city->id,
                ]
            );
        });
    }
}
