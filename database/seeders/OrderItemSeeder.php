<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        OrderItem::create([
            'order_id' => 1,
            'product_id' => 1,
            'variant_id' => 1,
            'quantity' => 1,
            'price' => 25000,
        ]);

        OrderItem::create([
            'order_id' => 2,
            'product_id' => 2,
            'variant_id' => 2,
            'quantity' => 1,
            'price' => 120000,
        ]);

        OrderItem::create([
            'order_id' => 3,
            'product_id' => 3,
            'variant_id' => 3,
            'quantity' => 1,
            'price' => 80000,
        ]);

        OrderItem::create([
            'order_id' => 4,
            'product_id' => 4,
            'variant_id' => 2,
            'quantity' => 1,
            'price' => 15000,
        ]);

        OrderItem::create([
            'order_id' => 5,
            'product_id' => 1,
            'variant_id' => 4,
            'quantity' => 2,
            'price' => 32000,
        ]);
        OrderItem::create([
            'order_id' => 4,
            'product_id' => 1,
            'variant_id' => 5,
            'quantity' => 2,
            'price' => 42000,
        ]);
    }
}

