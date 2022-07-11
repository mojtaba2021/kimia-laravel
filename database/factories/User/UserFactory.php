<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function now;

class UserFactory extends Factory
{

    public function definition()
    {
        return [
//            'username' => $this->faker->name(),
            'firstname' => $this->faker->name(),
            'lastname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make("12345678"), // password
            'remember_token' => Str::random(10),

//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

        ];

    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
