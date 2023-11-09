<?php

namespace Database\Factories\General;

use App\Models\General\Testimony;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TestimonyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'photos' => 'photo.png',
            'position' => 'CEO',
            'company' => 'PT. Abcd Efgh',
            'testimoni' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1,5)
        ];
    }

}
