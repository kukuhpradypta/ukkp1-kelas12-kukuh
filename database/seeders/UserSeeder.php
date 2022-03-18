<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Joni',
            'foto' => 'default.png',
            'nik' => 12345678,
            'email' => 'admin@admin.com',
            'password' =>  Hash::make('password')
        ]);
    }
}
