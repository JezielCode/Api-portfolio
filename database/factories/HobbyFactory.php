<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hobby>
 */
class HobbyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> $this->faker->title,
            'description'=> $this->faker->text(50),
            'icon'=> $this->faker->imageUrl(800, 400, 'cats', true, 'Faker'),
            'user_id'=> User::inRandomOrder()->first()->id,
        ];
    }
}
