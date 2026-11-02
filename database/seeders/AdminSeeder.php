<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Hamza',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role' => 'admin',
            'is_approved' => true,
        ]);
        User::create([
            'name' => 'Hamza',
            'email' => 'hamza@gmail.com',
            'password' => 'hamza123',
            'role' => 'hospital',
            'is_approved' => true,
        ]);
        User::create([
            'name' => 'Hamza',
            'email' => 'hamza12@gmail.com',
            'password' => 'hamza123',
            'role' => 'parent',
            'is_approved' => true,
        ]);
    }
}
