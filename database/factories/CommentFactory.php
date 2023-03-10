<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Discussion;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{

    public function definition()
    {
        return [
            'discussion_id' => Discussion::factory(),
            'user_id' => User::factory(),
            'comment' => $this->faker->sentence(mt_rand(1, 2)),
        ];
    }
}
