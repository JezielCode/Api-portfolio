<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'degree'=> $this->faker->name,
            'description'=> $this->faker->text(50),
            'institution'=> $this->faker->jobTitle,
            'start_date'=> $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'end_date'=> $this->faker->dateTimeBetween('-1 year', '+3 year'),
            'user_id'=> User::inRandomOrder()->first()->id,
        ];
    }
}
