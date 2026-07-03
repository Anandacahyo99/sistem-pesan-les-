<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\Pengajar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    

public function definition(): array
    {
        return [
            // Mengambil ID pengajar secara acak dari data pengajar yang nanti dibuat, atau null (karena opsional)
            'pengajar_id' => fn() => Pengajar::inRandomOrder()->first()?->id ?? Pengajar::factory(),
            'nama_kelas'  => $this->faker->randomElement(['Web Development', 'Mobile Design', 'Data Science', 'Digital Marketing', 'Cyber Security']),
            'deskripsi'   => $this->faker->paragraph(),
            'harga'       => $this->faker->randomElement([500000, 750000, 1000000, 1500000]),
            'kuota'       => $this->faker->numberBetween(10, 30),
            'status'      => $this->faker->randomElement(['aktif', 'nonaktif']),
        ];
    }
}
