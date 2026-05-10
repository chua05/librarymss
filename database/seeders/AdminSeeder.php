<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@library.com'],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);

            User::firstOrCreate(
                ['email' => 'librarian@library.com'],
                [
                    'name' => 'Librarian',
                    'username' => 'librarian',
                    'password' => Hash::make('password'),
                    'role' => 'attendant',
                ]
            );
    }
}