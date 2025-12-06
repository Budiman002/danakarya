<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    $categories = [
        [
            'name' => 'Seni & Budaya',
            'slug' => 'seni-budaya',
            'description' => 'Campaign untuk seni, musik, film, teater, dan budaya lokal',
            'status' => 'active',
        ],
        [
            'name' => 'UMKM',
            'slug' => 'umkm',
            'description' => 'Campaign untuk usaha mikro, kecil, dan menengah',
            'status' => 'active',
        ],
        [
            'name' => 'Teknologi',
            'slug' => 'teknologi',
            'description' => 'Campaign untuk inovasi teknologi dan startup',
            'status' => 'active',
        ],
        [
            'name' => 'Pendidikan',
            'slug' => 'pendidikan',
            'description' => 'Campaign untuk program pendidikan dan pelatihan',
            'status' => 'active',
        ],
        [
            'name' => 'Kesehatan',
            'slug' => 'kesehatan',
            'description' => 'Campaign untuk kesehatan dan kesejahteraan',
            'status' => 'active',
        ],
        [
            'name' => 'Lingkungan',
            'slug' => 'lingkungan',
            'description' => 'Campaign untuk pelestarian lingkungan dan sustainability',
            'status' => 'active',
        ],
    ];

    foreach ($categories as $category) {
        \App\Models\Category::create($category);
    }
}
}
