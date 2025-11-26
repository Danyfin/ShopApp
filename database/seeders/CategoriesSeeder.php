<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Смартфоны'],
            ['name' => 'Ноутбуки'],
            ['name' => 'Телевизоры'],
            ['name' => 'Наушники'],
            ['name' => 'Аксессуары'],
        ]);
    }
}