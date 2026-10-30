<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@booksales.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 2. Akun Customer (User Biasa)
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@booksales.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);
    }
}
