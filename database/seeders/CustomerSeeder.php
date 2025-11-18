<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'name' => 'ShahzadAli',
            'email' => 'shahzad@example.com',
            'password' => Hash::make('shahzad123'),
            'address' => '123 Main Street, Lahore',
            'phone' => '03001234567',
        ]);

        Customer::create([
            'name' => 'Ayeza Khan',
            'email' => 'ayeza@example.com',
            'password' => Hash::make('ayeza123'),
            'address' => '45 Gulberg, Lahore',
            'phone' => '03007654321',
        ]);

        Customer::create([
            'name' => 'Shan Ali',
            'email' => 'shan@example.com',
            'password' => Hash::make('shan123'),
            'address' => '12 Model Town, Lahore',
            'phone' => '03211234567',
        ]);

        Customer::create([
            'name' => 'Hamza Bashir',
            'email' => 'hamza@example.com',
            'password' => Hash::make('hamza123'),
            'address' => '78 DHA, Lahore',
            'phone' => '03121234567',
        ]);
    }
}
