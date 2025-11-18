<?php
// database/seeders/ShopOwnerSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShopOwner;
use Illuminate\Support\Facades\Hash;

class ShopOwnerSeeder extends Seeder
{
    public function run()
    {
        ShopOwner::create([
            'name' => 'Ali Khan',
            'email' => 'ali@example.com',
            'password' => Hash::make('password123'),
            'shop_name' => 'Ali Electronics',
        ]);

        ShopOwner::create([
            'name' => 'Sara Ahmed',
            'email' => 'sara@example.com',
            'password' => Hash::make('password123'),
            'shop_name' => 'Sara Fashion',
        ]);

        ShopOwner::create([
            'name' => 'Usman Riaz',
            'email' => 'usman@example.com',
            'password' => Hash::make('password123'),
            'shop_name' => 'Usman Grocery',
        ]);

        ShopOwner::create([
            'name' => 'Hina Malik',
            'email' => 'hina@example.com',
            'password' => Hash::make('password123'),
            'shop_name' => 'Hina Cosmetics',
        ]);
    }
}
