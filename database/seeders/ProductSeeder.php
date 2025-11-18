<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'shop_owner_id' => 1,
            'name' => 'iPhone 14',
            'brand' => 'Apple',
            'description' => 'Latest Apple iPhone with A15 Bionic chip.',
            'price' => 120000,
            'stock' => 10,
            'image' => 'iphone14.jpg',
        ]);

        Product::create([
            'shop_owner_id' => 1,
            'name' => 'Samsung Galaxy S23',
            'brand' => 'Samsung',
            'description' => 'Flagship Samsung phone with high-end specs.',
            'price' => 95000,
            'stock' => 15,
            'image' => 'galaxy_s23.jpg',
        ]);

        Product::create([
            'shop_owner_id' => 2,
            'name' => 'Dell Inspiron 15',
            'brand' => 'Dell',
            'description' => 'Powerful laptop for home and office use.',
            'price' => 80000,
            'stock' => 5,
            'image' => 'dell_inspiron15.jpg',
        ]);

        Product::create([
            'shop_owner_id' => 3,
            'name' => 'Sony Headphones',
            'brand' => 'Sony',
            'description' => 'Noise-cancelling over-ear headphones.',
            'price' => 15000,
            'stock' => 20,
            'image' => 'sony_headphones.jpg',
        ]);

        Product::create([
            'shop_owner_id' => 4,
            'name' => 'Nike Air Max',
            'brand' => 'Nike',
            'description' => 'Comfortable running shoes.',
            'price' => 12000,
            'stock' => 30,
            'image' => 'nike_airmax.jpg',
        ]);
    }
}
