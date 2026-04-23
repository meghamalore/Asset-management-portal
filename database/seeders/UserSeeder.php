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
            ['name' => 'Employee', 'email' => 'employee@gmail.com', 'password' => 'employee@123456', 'role' => 'employee'],

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