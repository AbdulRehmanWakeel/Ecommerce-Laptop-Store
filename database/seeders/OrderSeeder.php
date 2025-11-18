<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'customer_id' => 1,
            'total_amount' => 25000,
            'status' => 'pending',
        ]);

        Order::create([
            'customer_id' => 2,
            'total_amount' => 120000,
            'status' => 'completed',
        ]);

        Order::create([
            'customer_id' => 3,
            'total_amount' => 80000,
            'status' => 'pending',
        ]);

        Order::create([
            'customer_id' => 4,
            'total_amount' => 15000,
            'status' => 'completed',
        ]);

        Order::create([
            'customer_id' => 1,
            'total_amount' => 32000,
            'status' => 'pending',
        ]);
    }
}

