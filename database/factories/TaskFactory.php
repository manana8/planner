<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
//            'user_id' => rand(1,5),
            'title' => Str::random(10),
            'text' => fake()->text,
            'category_id' => rand(1,5),
            'deadline' => fake()->date,
            'status' => Str::random(10),
            'data_of_create' => fake()->date,
            'data_of_done' => fake()->date,
        ];
    }
}
