<?php

namespace Database\Factories\Companies;

use App\Models\Master\ApplicationParameter;
use App\Models\Master\City;
use App\Models\Master\Province;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $province = Province::where('name', 'DAERAH KHUSUS IBUKOTA JAKARTA')->first();
        $city = City::where('name', 'JAKARTA PUSAT')->first();
        $empSize = ApplicationParameter::where('type', 'employee_sizes')->where('code', 'cs_size_3')->first();
        $compIndstry = ApplicationParameter::where('type', 'company_industries')->where('code', 'cs_industry_3')->first();
        
        $slugCombination = fake()->name();
        return [
            'name' => $slugCombination,
            'email' => fake()->email(),
            'description'=> fake()->paragraph(),
            'phone_number'=> fake()->phoneNumber(),
            'province_id' => $province->id,
            'city_id' => $city->id,
            'address' => fake()->address(),
            'zip_code' => '12345',
            'employee_size_id' => $empSize->id,
            'company_industry_id' => $compIndstry->id,
            'website' => fake()->url(),
            'since_year' => fake()->year(),
            'slug' => Str::slug($slugCombination, '-'),
        ];
    }

}
