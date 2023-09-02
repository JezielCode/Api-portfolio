<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> $this->faker->name,
            'description'=> $this->faker->text(50),
            'icon'=> $this->faker->imageUrl(800, 400, 'cats', true, 'Faker'),
            'user_id'=> User::inRandomOrder()->first()->id,
        ];
    }
}
