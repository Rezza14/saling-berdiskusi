<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscussionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(mt_rand(1, 2)),
            'tags' => $this->faker->sentence(mt_rand(1, 2)),
            'created_at' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
        ];
    }
}
