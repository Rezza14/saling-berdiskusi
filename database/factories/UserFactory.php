<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $image = UploadedFile::fake()->image('user.jpg');

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'username' => $this->faker->userName(),
            'email_verified_at' => now(),
            'image' => app()->runningUnitTests() ? $image : $image->store('image/users', 'public'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(function () {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function verified(): static
    {
        return $this->state(function () {
            return [
                'email_verified_at' => now(),
            ];
        });
    }
}
