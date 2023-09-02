<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model= User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'last_name' =>$this->faker->lastName,
            'year_of_birth' =>$this->faker-> year,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password')
        ];
    }
}
