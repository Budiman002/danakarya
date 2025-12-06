<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    // Admin
    \App\Models\User::create([
        'name' => 'Admin DanaKarya',
        'email' => 'admin@danakarya.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
        'bio' => 'Administrator platform DanaKarya',
    ]);

    // Creators
    \App\Models\User::create([
        'name' => 'Ibu Siti',
        'email' => 'siti@example.com',
        'password' => bcrypt('password'),
        'role' => 'creator',
        'bio' => 'Pemilik Warung Makan Padang Ibu Siti',
        'phone' => '081234567890',
    ]);

    \App\Models\User::create([
        'name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'password' => bcrypt('password'),
        'role' => 'creator',
        'bio' => 'Pengrajin batik tulis dari Solo',
        'phone' => '081234567891',
    ]);

    // Backers
    \App\Models\User::create([
        'name' => 'Ahmad Wijaya',
        'email' => 'ahmad@example.com',
        'password' => bcrypt('password'),
        'role' => 'backer',
        'bio' => 'Mahasiswa yang suka support UMKM lokal',
    ]);

    \App\Models\User::create([
        'name' => 'Rina Kusuma',
        'email' => 'rina@example.com',
        'password' => bcrypt('password'),
        'role' => 'backer',
    ]);

    \App\Models\User::create([
        'name' => 'Dimas Prasetyo',
        'email' => 'dimas@example.com',
        'password' => bcrypt('password'),
        'role' => 'backer',
    ]);
}
}
