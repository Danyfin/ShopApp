<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            // Смартфоны
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Новый iPhone с титановым корпусом и камерой 48 МП',
                'price' => 99990,
                'quantity' => 15,
                'image_url' => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-15-pro-finish-select-202309-6-7inch-naturaltitanium?wid=5120&hei=2880&fmt=webp',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'Флагманский смартфон с искусственным интеллектом',
                'price' => 79990,
                'quantity' => 20,
                'image_url' => 'https://images.samsung.com/is/image/samsung/p6pim/ru/2401/gallery/ru-galaxy-s24-s928-sm-s928bzkgser-539223756',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Xiaomi Redmi Note 13',
                'description' => 'Популярный смартфон с отличным соотношением цена/качество',
                'price' => 24990,
                'quantity' => 30,
                'image_url' => 'https://i01.appmifile.com/webfile/globalimg/products/pc/redmi-note-13/specs-header.png',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Ноутбуки
            [
                'name' => 'MacBook Air M3',
                'description' => 'Мощный и легкий ноутбук от Apple',
                'price' => 129990,
                'quantity' => 8,
                'image_url' => 'https://www.apple.com/newsroom/images/product/mac/standard/Apple_MacBook-Air_13-inch_M3_03182024_big.jpg.large.jpg',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ASUS ROG Strix',
                'description' => 'Игровой ноутбук с RTX 4060 для геймеров',
                'price' => 149990,
                'quantity' => 5,
                'image_url' => 'https://dlcdnwebimgs.asus.com/gain/4A43A0B2-1E5A-4A9F-9D9B-2B5C8B1B8C25',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lenovo IdeaPad 5',
                'description' => 'Универсальный ноутбук для работы и учебы',
                'price' => 54990,
                'quantity' => 12,
                'image_url' => 'https://p2-ofp.static.pub/fes/cms/2023/02/21/9p6gv0m3z5w7b8t2v4d6f8h0j2l4n6p818264',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Телевизоры
            [
                'name' => 'Samsung QLED 4K 55"',
                'description' => 'Телевизор с технологией QLED и Smart TV',
                'price' => 69990,
                'quantity' => 10,
                'image_url' => 'https://images.samsung.com/is/image/samsung/p6pim/ru/qe55q60cauxru/gallery/ru-qled-q60c-qe55q60cauxru-534866064',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LG OLED 65"',
                'description' => 'Премиальный OLED телевизор с идеальным черным',
                'price' => 129990,
                'quantity' => 6,
                'image_url' => 'https://www.lg.com/ru/images/televisions/md07569715/gallery/OLED65C3RLA_1100_01.jpg',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Наушники
            [
                'name' => 'AirPods Pro 2',
                'description' => 'Беспроводные наушники с шумоподавлением',
                'price' => 24990,
                'quantity' => 25,
                'image_url' => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/airpods-pro-2-hero-select-202409_FMT_WHH?wid=750&hei=556&fmt=jpeg&qlt=80&.v=1723619284314',
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'description' => 'Наушники с лучшим шумоподавлением на рынке',
                'price' => 32990,
                'quantity' => 15,
                'image_url' => 'https://www.sony.ru/image/5c8dfb6c0dd907a0d5b9e6e3e4b4e6f7?fmt=pjpeg&wid=750&hei=750',
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Аксессуары
            [
                'name' => 'Чехол для iPhone 15',
                'description' => 'Силиконовый чехол с защитой от ударов',
                'price' => 2990,
                'quantity' => 50,
                'image_url' => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/MQ0X3?wid=1144&hei=1144&fmt=jpeg&qlt=95&.v=1693085736246',
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'USB-C кабель 2м',
                'description' => 'Быстрый кабель для зарядки и синхронизации',
                'price' => 1490,
                'quantity' => 100,
                'image_url' => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/MQGH3?wid=1144&hei=1144&fmt=jpeg&qlt=95&.v=1660669971144',
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}