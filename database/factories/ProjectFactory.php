<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyect>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> $this->faker->sentence,
            'description'=> $this->faker->text(50),
            'imagen'=> $this->faker->imageUrl(640, 480),
            'link'=> $this->faker->url,
            'content'=> $this->faker->paragraphs(2, true),
            'user_id'=> User::inRandomOrder()->first()->id,
        ];
    }
}


