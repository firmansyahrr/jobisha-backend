<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Companies\Company;
use App\Models\General\Testimony;
use App\Models\Job\Job;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AppParamCareerLevel::class,
            AppParamCompanyIndustry::class,
            AppParamEmployeeSize::class,
            AppParamJobType::class,
            AppParamJobPreference::class,
            AppParamRangeSalary::class,
            AppParamSkillLevel::class,
            AppParamEducationLevel::class,
            AppParamGender::class,

            MasterCountrySeeder::class,
            MasterProvinceSeeder::class,
            MasterCitySeeder::class,

            JobSpecializationSeeder::class,
            JobRoleSeeder::class,

            UserPermission::class,
            UserRole::class,
            UserSuperAdmin::class,
        ]);

        if(Testimony::get()->count() == 0){
            Testimony::factory(10)->create();
        }

        if(Company::get()->count() == 0){
            Company::factory(1)->create();
        }

        if(Job::get()->count() == 0){
            Job::factory(50)->create();

            $this->call([
                JobPreferenceSeeder::class,
                JobLocationSeeder::class,
            ]);
        }
    }
}
