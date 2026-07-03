<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

// Perhatikan penulisan nama class: HARUS "UserFactory" (U dan F kapital)
class UserFactory extends Factory
{
    /**
     * Nama model yang terkait dengan factory ini.
     */
    protected $model = User::class;

    /**
     * Definisi state default model.
     */
    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => bcrypt('password'), // password default
            'remember_token'    => Str::random(10),
        ];
    }
}