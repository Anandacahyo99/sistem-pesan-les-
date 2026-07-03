<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = User::firstOrCreate(
            [
                'email' => 'nanda@gmail.com'
            ],
            [
                'name' => 'Administrator',
                'password' => bcrypt('anandacahyo')
            ]
        );

        $siswa->assignRole('siswa');
    }
}