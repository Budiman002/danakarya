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

        // Additional campaigns from your database
        $educationCategory = Category::where('name', 'Education')->first();
        $healthCategory = Category::where('name', 'Health')->first();
        $artsCategory = Category::where('name', 'Seni & Budaya')->first();

        if ($creator && $umkmCategory) {
            \App\Models\Campaign::firstOrCreate(
                ['slug' => 'warung-makan-padang-bu-siti'],
                [
                    'title' => 'Warung Makan Padang Bu Siti - Ekspansi Cabang Ketiga',
                    'description' => 'Membantu Bu Siti membuka cabang ketiga warung makan Padang yang sudah terkenal lezat di Jakarta.',
                    'target_amount' => 100000000,
                    'current_amount' => 45000000,
                    'deadline' => now()->addDays(45),
                    'category_id' => $umkmCategory->id,
                    'user_id' => $creator->id,
                    'status' => 'cancelled',
                    'image' => 'images/campaigns/default.jpg',
                ]
            );

            \App\Models\Campaign::firstOrCreate(
                ['slug' => 'kedai-kopi-lokal-roasting-equipment'],
                [
                    'title' => 'Kedai Kopi Lokal - Roasting Equipment',
                    'description' => 'Kedai kopi lokal yang ingin upgrade mesin roasting untuk menghasilkan kopi berkualitas lebih baik.',
                    'target_amount' => 85000000,
                    'current_amount' => 63000000,
                    'deadline' => now()->addDays(365),
                    'category_id' => $umkmCategory->id,
                    'user_id' => $creator->id,
                    'status' => 'active',
                    'image' => 'images/campaigns/default.jpg',
                ]
            );
        }

        if ($creator && $artsCategory) {
            \App\Models\Campaign::firstOrCreate(
                ['slug' => 'pengrajin-batik-tulis-yogyakarta'],
                [
                    'title' => 'Pengrajin Batik Tulis Yogyakarta - Mesin Modern',
                    'description' => 'Bantu pengrajin batik tradisional Yogyakarta untuk mendapatkan mesin modern tanpa meninggalkan nilai seni tradisional.',
                    'target_amount' => 75000000,
                    'current_amount' => 75000000,
                    'deadline' => now()->addDays(365),
                    'category_id' => $artsCategory->id,
                    'user_id' => $creator->id,
                    'status' => 'funded',
                    'image' => 'images/campaigns/default.jpg',
                ]
            );
        }

        // Create additional users
        $budi = User::firstOrCreate(
            ['email' => 'budi@example.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password123'),
                'role' => 'creator',
            ]
        );

        $siti = User::firstOrCreate(
            ['email' => 'siti@example.com'],
            [
                'name' => 'Ibu Siti',
                'password' => Hash::make('password123'),
                'role' => 'creator',
            ]
        );

        // Campaigns from other creators
        if ($budi && $educationCategory) {
            \App\Models\Campaign::firstOrCreate(
                ['slug' => 'aplikasi-pembelajaran-bahasa-daerah'],
                [
                    'title' => 'Aplikasi Pembelajaran Bahasa Daerah untuk Anak SD',
                    'description' => 'Aplikasi mobile untuk melestarikan bahasa daerah Indonesia melalui pembelajaran yang menyenangkan.',
                    'target_amount' => 120000000,
                    'current_amount' => 37000000,
                    'deadline' => now()->addDays(90),
                    'category_id' => $educationCategory->id,
                    'user_id' => $budi->id,
                    'status' => 'active',
                    'image' => 'images/campaigns/default.jpg',
                ]
            );
        }

        if ($siti && $educationCategory) {
            \App\Models\Campaign::firstOrCreate(
                ['slug' => 'perpustakaan-mini-desa-terpencil'],
                [
                    'title' => 'Perpustakaan Mini untuk Desa Terpencil Nusa Tenggara',
                    'description' => 'Membangun perpustakaan mini dengan koleksi buku berkualitas untuk anak-anak di desa terpencil.',
                    'target_amount' => 50000000,
                    'current_amount' => 49000000,
                    'deadline' => now()->addDays(30),
                    'category_id' => $educationCategory->id,
                    'user_id' => $siti->id,
                    'status' => 'active',
                    'image' => 'images/campaigns/default.jpg',
                ]
            );
        }

        echo "✅ Database seeded successfully!\n";
        echo "👨‍💼 Admin: admin@danakarya.com / password123\n";
        echo "👤 Creator: creator@danakarya.com / password123\n";
        echo "👥 Backer: backer@danakarya.com / password123\n";
        echo "📊 Total Campaigns: " . \App\Models\Campaign::count() . "\n";
    }
}