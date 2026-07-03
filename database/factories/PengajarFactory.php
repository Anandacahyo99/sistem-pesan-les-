<?php

namespace Database\Factories;

use App\Models\Pengajar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pengajar>
 */
class PengajarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        // Otomatis membuat User baru dan mengambil ID-nya
        'user_id'  => User::factory(), 
        'no_hp'    => $this->faker->phoneNumber(),
        'alamat'   => $this->faker->address(),
        'keahlian' => $this->faker->randomElement(['Web Developer', 'UI/UX Designer', 'Data Scientist']),
        'foto'     => null,
    ];
}
}
