<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(1, 2)),
            'slug' => $this->faker->unique()->slug(),
            'created_at' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
        ];
    }
}
