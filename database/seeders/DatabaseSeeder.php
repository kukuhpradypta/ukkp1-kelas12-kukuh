<?php

namespace Database\Seeders;

use App\Models\Catatanperjalanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'foto' => 'default.png',
            'nik' => '12345678',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'kukuh',
            'foto' => 'default.png',
            'nik' => '12345678',
            'email' => 'kukuhpaa@gmail.com',
            'password' => Hash::make('password'),
        ]);
        Catatanperjalanan::create([
            'id_user' => '1',
            'tgl' => '2022-1-01',
            'jam' => '19.00',
            'lokasi' => 'depok',
            'suhu' => '50',
            'foto' => 'default.png',
        ]);
        Catatanperjalanan::create([
            'id_user' => '2',
            'tgl' => '2022-1-01',
            'jam' => '19.00',
            'lokasi' => 'depok',
            'suhu' => '50',
            'foto' => 'default.png',
        ]);
    }
}
