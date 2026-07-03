<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Pengajar = User::firstOrCreate(
            [
                'email' => 'pengajar1@gmail.com'
            ],

            [
                'name'=> 'pengajar 1',
                'password' => bcrypt('pengajarsatu')
            ]
            );

        $Pengajar->assignRole('pengajar');
    }
}
