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
        // Create Admin (only if not exists)
        User::firstOrCreate(
            ['email' => 'admin@danakarya.com'],
            [
                'name' => 'Admin DanaKarya',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Create Test Creator (only if not exists)
        User::firstOrCreate(
            ['email' => 'creator@danakarya.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password123'),
                'role' => 'creator',
            ]
        );

        // Create Test Backer (only if not exists)
        User::firstOrCreate(
            ['email' => 'backer@danakarya.com'],
            [
                'name' => 'Ibu Siti',
                'password' => Hash::make('password123'),
                'role' => 'backer',
            ]
        );

        // Create Categories
        $categories = [
            ['name' => 'UMKM', 'description' => 'Usaha Mikro, Kecil dan Menengah', 'icon' => '🏪'],
            ['name' => 'Technology', 'description' => 'Tech and innovation projects', 'icon' => '💻'],
            ['name' => 'Education', 'description' => 'Educational initiatives', 'icon' => '📚'],
            ['name' => 'Health', 'description' => 'Healthcare and wellness', 'icon' => '🏥'],
            ['name' => 'Environment', 'description' => 'Environmental conservation', 'icon' => '🌱'],
            ['name' => 'Social', 'description' => 'Social impact projects', 'icon' => '🤝'],
            ['name' => 'Arts', 'description' => 'Creative and artistic projects', 'icon' => '🎨'],
            ['name' => 'Seni & Budaya', 'description' => 'Seni dan Budaya Indonesia', 'icon' => '🎭'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }

        // Create Sample Campaigns (only if not exists)
        $creator = User::where('email', 'creator@danakarya.com')->first();
        $umkmCategory = Category::where('name', 'UMKM')->first();
        $techCategory = Category::where('name', 'Technology')->first();

        if ($creator && $umkmCategory) {
            \App\Models\Campaign::firstOrCreate(
                ['slug' => 'warung-kopi-pak-budi-renovasi'],
                [
                    'title' => 'Warung Kopi Pak Budi - Renovasi',
                    'description' => 'Bantu Pak Budi merenovasi warung kopinya agar lebih nyaman untuk pelanggan.',
                    'target_amount' => 10000000,
                    'current_amount' => 3500000,
                    'deadline' => now()->addDays(30),
                    'category_id' => $umkmCategory->id,
                    'user_id' => $creator->id,
                    'status' => 'active',
                    'image' => 'images/campaigns/default.jpg',
                ]
            );
        }

        if ($creator && $techCategory) {
            \App\Models\Campaign::firstOrCreate(
                ['slug' => 'aplikasi-belajar-online-anak-sd'],
                [
                    'title' => 'Aplikasi Belajar Online untuk Anak SD',
                    'description' => 'Kembangkan aplikasi belajar online yang interaktif untuk anak-anak SD di Indonesia.',
                    'target_amount' => 50000000,
                    'current_amount' => 12000000,
                    'deadline' => now()->addDays(60),
                    'category_id' => $techCategory->id,
                    'user_id' => $creator->id,
                    'status' => 'active',
                    'image' => 'images/campaigns/default.jpg',
                ]
            );
        }

        echo "✅ Database seeded successfully!\n";
        echo "👨‍💼 Admin: admin@danakarya.com / password123\n";
        echo "👤 Creator: creator@danakarya.com / password123\n";
        echo "👥 Backer: backer@danakarya.com / password123\n";
    }
}