<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::updateOrCreate(
        //     ['email' => 'admin@laptopstore.com'],
        //     [
        //         'name' => 'Super Admin',
        //         'password' => Hash::make('admin123'),
        //         'email_verified_at' => now(),

        //     ]
        // );
        $this->call([
            // ShopOwnerSeeder::class,
            // CustomerSeeder::class,
            // ProductSeeder::class,
            // OrderSeeder::class,
            VariantSeeder::class,
            OrderItemSeeder::class,
        ]);

    }
}
