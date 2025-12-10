<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin DanaKarya',
            'email' => 'admin@danakarya.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Test Creator
        User::create([
            'name' => 'John Creator',
            'email' => 'creator@danakarya.com',
            'password' => Hash::make('password'),
            'role' => 'creator',
        ]);

        // Create Test Backer
        User::create([
            'name' => 'Jane Backer',
            'email' => 'backer@danakarya.com',
            'password' => Hash::make('password'),
            'role' => 'backer',
        ]);

        // Create Categories
        Category::create(['name' => 'Technology', 'description' => 'Tech projects']);
        Category::create(['name' => 'Education', 'description' => 'Educational projects']);
        Category::create(['name' => 'Health', 'description' => 'Healthcare projects']);
        Category::create(['name' => 'Environment', 'description' => 'Environmental projects']);
        Category::create(['name' => 'Social', 'description' => 'Social impact projects']);
    }
}