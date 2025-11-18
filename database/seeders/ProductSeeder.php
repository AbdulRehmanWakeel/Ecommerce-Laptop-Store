<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'shop_owner_id' => 1,
                'name' => 'MacBook Pro 14-inch',
                'brand' => 'Apple',
                'description' => 'Powerful laptop for professionals with M3 Pro chip',
                'model_name' => 'MacBook Pro 14" M3 Pro',
                'category' => 'laptop',
                'operating_system' => 'macOS',
                'price' => 1999.00,
                'stock' => 25,
                'image' => 'macbook-pro-14.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_owner_id' => 1,
                'name' => 'Dell XPS 13',
                'brand' => 'Dell',
                'description' => 'Ultra-thin laptop with InfinityEdge display',
                'model_name' => 'XPS 13 9320',
                'category' => 'laptop',
                'operating_system' => 'Windows 11',
                'price' => 1299.00,
                'stock' => 15,
                'image' => 'dell-xps-13.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_owner_id' => 1,
                'name' => 'ThinkPad X1 Carbon',
                'brand' => 'Lenovo',
                'description' => 'Business laptop with military-grade durability',
                'model_name' => 'X1 Carbon Gen 11',
                'category' => 'laptop',
                'operating_system' => 'Windows 11 Pro',
                'price' => 1599.00,
                'stock' => 20,
                'image' => 'thinkpad-x1-carbon.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_owner_id' => 1,
                'name' => 'HP Spectre x360',
                'brand' => 'HP',
                'description' => '2-in-1 convertible laptop with OLED display',
                'model_name' => 'Spectre x360 14',
                'category' => 'laptop',
                'operating_system' => 'Windows 11',
                'price' => 1399.00,
                'stock' => 12,
                'image' => 'hp-spectre-x360.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_owner_id' => 1,
                'name' => 'ASUS ROG Zephyrus',
                'brand' => 'ASUS',
                'description' => 'Gaming laptop with RTX 4060 graphics',
                'model_name' => 'ROG Zephyrus G14',
                'category' => 'laptop',
                'operating_system' => 'Windows 11',
                'price' => 1799.00,
                'stock' => 8,
                'image' => 'asus-rog-zephyrus.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_owner_id' => 2,
                'name' => 'Surface Laptop 5',
                'brand' => 'Microsoft',
                'description' => 'Sleek laptop with PixelSense touchscreen',
                'model_name' => 'Surface Laptop 5 13.5"',
                'category' => 'laptop',
                'operating_system' => 'Windows 11',
                'price' => 1199.00,
                'stock' => 18,
                'image' => 'surface-laptop-5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_owner_id' => 3,
                'name' => 'MacBook Air 15-inch',
                'brand' => 'Apple',
                'description' => 'Thin and light laptop with M2 chip',
                'model_name' => 'MacBook Air 15" M2',
                'category' => 'laptop',
                'operating_system' => 'macOS',
                'price' => 1299.00,
                'stock' => 22,
                'image' => 'macbook-air-15.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shop_owner_id' => 4,
                'name' => 'Acer Swift 3',
                'brand' => 'Acer',
                'description' => 'Affordable ultrabook for everyday use',
                'model_name' => 'Swift 3 SF314',
                'category' => 'laptop',
                'operating_system' => 'Windows 11',
                'price' => 699.00,
                'stock' => 30,
                'image' => 'acer-swift-3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('products')->insert($products);
    }
}