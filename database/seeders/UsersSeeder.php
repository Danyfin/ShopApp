<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'login' => 'Дануфин',
                'email' => 'danyfin871@gmail.com',
                'password' => Hash::make('Danyfin871'),
                'role' => 'user',
            ],
            [
                'login' => 'Админ',
                'email' => 'admin123@gmail.com',
                'password' => Hash::make('Admin123'),
                'role' => 'admin',
            ],
            [
                'login' => 'Продавец',
                'email' => 'saler@gmail.com',
                'password' => Hash::make('Danyfin871'),
                'role' => 'seller',
            ],
        ]);
    }
}