<?php

namespace Database\Factories\Job;

use App\Models\Companies\Company;
use App\Models\Job\JobRole;
use App\Models\Job\JobSpecialization;
use App\Models\Master\ApplicationParameter;
use App\Models\Master\City;
use App\Models\Master\Province;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company = Company::first();
        $jobSpecialization = JobSpecialization::where('code', 'software_engineer')->first();
        $jobRole = JobRole::where('code', 'fullstack_developer')->first();

        $jobType = ApplicationParameter::where('type', 'job_types')->where('code', 'jt_fulltime')->first();
        $careerLevel = ApplicationParameter::where('type', 'career_levels')->where('code', 'cl_level_1')->first();

        $title = fake()->jobTitle();
        $slugCombination = $company->name . " " . $title . " " . $jobSpecialization->label. " " . $jobRole->label;
        return [
            'company_id' => $company->id,
            'job_type_id' => $jobType->id,
            'title' => $title,
            'job_description' => fake()->paragraph(),
            'requirement' => fake()->paragraph(),
            'responsibilities' => fake()->paragraph(),
            'benefit' => fake()->paragraph(),
            'qualification' => fake()->paragraph(),
            'year_of_experience' => fake()->numberBetween(1, 10),
            'min_sallary' => fake()->numberBetween(1000000, 10000000),
            'max_sallary' => fake()->numberBetween(1000000, 10000000),
            'career_level_id' => $careerLevel->id,
            'job_role_id' => $jobRole->id,
            'job_specialization_id' => $jobSpecialization->id,
            'valid_until' => fake()->date(),
            'slug' => Str::slug($slugCombination, '-'),
        ];
    }
}
