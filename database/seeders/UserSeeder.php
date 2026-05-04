<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $users = [

            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => 'admin@123456', 'role' => 'admin'],
            ['name' => 'Megha Malore', 'email' => 'megha@gmail.com', 'password' => 'Megha@123456', 'role' => 'employee'],
            ['name' => 'Ketan Vyas', 'email' => 'ketan@gmail.com', 'password' => 'ketan@123456', 'role' => 'User'],
            ['name' => 'Bhagesh Kadam', 'email' => 'bhagesh@gmail.com', 'password' => 'bhagesh@123456', 'role' => 'User'],

        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'role' => $user['role'],
            ]);
        }
    }
}