<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            "name" => "Sonam Tamang",
            "email" => "sonam@admin.com",
            "password" => Hash::make("password"),
        ]);
    }
}
