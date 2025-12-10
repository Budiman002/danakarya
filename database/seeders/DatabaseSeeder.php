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
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create Test Creator
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'creator@danakarya.com',
            'password' => Hash::make('password123'),
            'role' => 'creator',
        ]);

        // Create Test Backer
        User::create([
            'name' => 'Ibu Siti',
            'email' => 'backer@danakarya.com',
            'password' => Hash::make('password123'),
            'role' => 'backer',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Technology', 'description' => 'Tech and innovation projects'],
            ['name' => 'Education', 'description' => 'Educational initiatives'],
            ['name' => 'Health', 'description' => 'Healthcare and wellness'],
            ['name' => 'Environment', 'description' => 'Environmental conservation'],
            ['name' => 'Social', 'description' => 'Social impact projects'],
            ['name' => 'Arts', 'description' => 'Creative and artistic projects'],
            ['name' => 'Business', 'description' => 'Small business and entrepreneurship'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}