<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Pengajar;
use App\Models\User;
use Database\Seeders\SiswaSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $this->call([
        //     RoleSeeder::class,
        //     AdminSeeder::class,
        //     SiswaSeeder::class,
        //     PengajarSeeder::class,
        // ]);

        // 1. Buat 5 data pengajar dummy terlebih dahulu
        Pengajar::factory(5)->create();

        // 2. Buat 20 data kelas dummy yang akan otomatis terhubung dengan pengajar di atas
        Kelas::factory(20)->create();
    }
}
