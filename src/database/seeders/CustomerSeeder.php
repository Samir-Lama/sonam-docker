<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::create([
            "name" => "Sonam Tamang",
            "email" => "sonam@customer.com",
            "phone" => "9876543210",
            "address" => "Kathmandu, Nepal",
            "password" => Hash::make("password"),
        ]);
    }
}
