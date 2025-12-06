<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Category;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        
        // Creator 1: Siti (Warung Makan)
        $siti = User::where('email', 'siti@example.com')->first();
        
        // Creator 2: Budi (Pengrajin Batik)
        $budi = User::where('email', 'budi@example.com')->first();

        // Campaign 1: Warung Makan (Active)
        Campaign::create([
            'user_id' => $siti->id,
            'category_id' => $categories->where('slug', 'umkm')->first()->id,
            'title' => 'Warung Makan Padang Bu Siti - Ekspansi Cabang Kedua',
            'slug' => 'warung-makan-padang-bu-siti',
            'description' => 'Warung makan Padang yang telah berdiri 10 tahun ingin membuka cabang kedua. Dana akan digunakan untuk sewa tempat, renovasi, peralatan dapur, dan modal awal. Target pembukaan 3 bulan ke depan.',
            'target_amount' => 100000000,
            'current_amount' => 45000000,
            'deadline' => now()->addMonths(2),
            'image' => 'images/campaigns/Campaign1WarungBusiti.jpeg',
            'status' => 'active',
        ]);

        // Campaign 2: Batik (Active)
        Campaign::create([
            'user_id' => $budi->id,
            'category_id' => $categories->where('slug', 'seni-budaya')->first()->id,
            'title' => 'Pengrajin Batik Tulis Yogyakarta - Mesin Modern',
            'slug' => 'pengrajin-batik-tulis-yogyakarta',
            'description' => 'Usaha batik tulis tradisional membutuhkan mesin modern untuk meningkatkan produksi tanpa mengurangi kualitas. Dana untuk mesin pewarna otomatis dan pelatihan karyawan.',
            'target_amount' => 75000000,
            'current_amount' => 30000000,
            'deadline' => now()->addMonths(3),
            'image' => 'images/campaigns/Campaign2BatikTulis.jpeg',
            'status' => 'active',
        ]);

        // Campaign 3: Kopi (Active)
        Campaign::create([
            'user_id' => $siti->id,
            'category_id' => $categories->where('slug', 'umkm')->first()->id,
            'title' => 'Kedai Kopi Lokal - Roasting Equipment',
            'slug' => 'kedai-kopi-lokal-roasting',
            'description' => 'Kedai kopi yang menjual biji kopi lokal Gayo membutuhkan mesin roasting profesional untuk meningkatkan kualitas dan kapasitas produksi. Target: 50kg/hari.',
            'target_amount' => 85000000,
            'current_amount' => 62000000,
            'deadline' => now()->addMonth(),
            'image' => 'images/campaigns/Campaign3KedaiKopi.jpeg',
            'status' => 'active',
        ]);

        // Campaign 4: Teknologi (Active)
        Campaign::create([
            'user_id' => $budi->id,
            'category_id' => $categories->where('slug', 'teknologi')->first()->id,
            'title' => 'Aplikasi Pembelajaran Bahasa Daerah untuk Anak SD',
            'slug' => 'aplikasi-pembelajaran-bahasa-daerah',
            'description' => 'Mengembangkan aplikasi mobile untuk pembelajaran bahasa daerah (Jawa, Sunda, Bali) dengan metode gamifikasi. Dana untuk development, ilustrasi, dan testing.',
            'target_amount' => 120000000,
            'current_amount' => 25000000,
            'deadline' => now()->addMonths(4),
            'image' => 'images/campaigns/Campaign4NusantaraApp.jpeg',
            'status' => 'active',
        ]);

        // Campaign 5: Pendidikan (Active)
        Campaign::create([
            'user_id' => $siti->id,
            'category_id' => $categories->where('slug', 'pendidikan')->first()->id,
            'title' => 'Perpustakaan Mini untuk Desa Terpencil Nusa Tenggara',
            'slug' => 'perpustakaan-mini-desa-terpencil',
            'description' => 'Membangun perpustakaan mini dengan 1000 buku untuk anak-anak di desa terpencil. Termasuk rak buku, meja baca, dan program literasi mingguan selama 1 tahun.',
            'target_amount' => 50000000,
            'current_amount' => 48000000,
            'deadline' => now()->addWeeks(3),
            'image' => 'images/campaigns/Campaign5PerpustakaanMini.jpeg',
            'status' => 'active',
        ]);

        // Campaign 6: Kesehatan (Active)
        Campaign::create([
            'user_id' => $budi->id,
            'category_id' => $categories->where('slug', 'kesehatan')->first()->id,
            'title' => 'Posyandu Mobile untuk Daerah Pegunungan',
            'slug' => 'posyandu-mobile-pegunungan',
            'description' => 'Mobil posyandu keliling untuk melayani ibu hamil dan balita di daerah pegunungan. Dilengkapi alat kesehatan dasar, obat-obatan, dan tenaga medis terlatih.',
            'target_amount' => 150000000,
            'current_amount' => 89000000,
            'deadline' => now()->addMonths(2),
            'image' => 'images/campaigns/Campaign6PosyanduMobile.jpeg',
            'status' => 'active',
        ]);

        // Campaign 7: Lingkungan (Active)
        Campaign::create([
            'user_id' => $siti->id,
            'category_id' => $categories->where('slug', 'lingkungan')->first()->id,
            'title' => 'Bank Sampah Digital - Aplikasi Pengelolaan Sampah',
            'slug' => 'bank-sampah-digital',
            'description' => 'Sistem digital untuk bank sampah di 10 kelurahan. Warga bisa tracking sampah yang disetorkan, mendapat poin reward, dan edukasi pengelolaan sampah yang benar.',
            'target_amount' => 95000000,
            'current_amount' => 35000000,
            'deadline' => now()->addMonths(3),
            'image' => 'images/campaigns/Campaign7BankSampah.jpeg',
            'status' => 'active',
        ]);

        // Campaign 8: Kerajinan (Active)
        Campaign::create([
            'user_id' => $budi->id,
            'category_id' => $categories->where('slug', 'seni-budaya')->first()->id,
            'title' => 'Kerajinan Anyaman Bambu - Ekspor Pasar Eropa',
            'slug' => 'kerajinan-anyaman-bambu-ekspor',
            'description' => 'Pengrajin anyaman bambu tradisional ingin ekspansi ke pasar Eropa. Dana untuk sertifikasi produk, branding, packaging ramah lingkungan, dan marketing online.',
            'target_amount' => 80000000,
            'current_amount' => 55000000,
            'deadline' => now()->addMonths(2)->addWeeks(2),
            'image' => 'images/campaigns/Campaign8KerajinanBambu.jpeg',
            'status' => 'active',
        ]);

        // Campaign 9: UMKM Fashion (Active)
        Campaign::create([
            'user_id' => $siti->id,
            'category_id' => $categories->where('slug', 'umkm')->first()->id,
            'title' => 'Brand Fashion Lokal "Nusantara Wear" - Online Store',
            'slug' => 'brand-fashion-nusantara-wear',
            'description' => 'Brand fashion berbahan kain tradisional Indonesia ingin launching online store. Dana untuk fotografi produk, website e-commerce, inventory awal, dan digital marketing 6 bulan.',
            'target_amount' => 110000000,
            'current_amount' => 72000000,
            'deadline' => now()->addMonth()->addWeeks(3),
            'image' => 'images/campaigns/Campaign9NusantaraWear.jpeg',
            'status' => 'active',
        ]);

        // Campaign 10: Teknologi Pertanian (Active)
        Campaign::create([
            'user_id' => $budi->id,
            'category_id' => $categories->where('slug', 'teknologi')->first()->id,
            'title' => 'Smart Farming IoT untuk Petani Sayuran Organik',
            'slug' => 'smart-farming-iot-organik',
            'description' => 'Sistem monitoring tanaman otomatis dengan sensor kelembaban, suhu, dan nutrisi tanah. Data real-time via smartphone untuk 20 petani sayuran organik di Bandung.',
            'target_amount' => 135000000,
            'current_amount' => 18000000,
            'deadline' => now()->addMonths(4),
            'image' => 'images/campaigns/Campaign10SmartFarmingIOT.jpeg',
            'status' => 'active',
        ]);

        // Campaign 11: Funded (Success story)
        Campaign::create([
            'user_id' => $siti->id,
            'category_id' => $categories->where('slug', 'umkm')->first()->id,
            'title' => 'Toko Roti & Kue Tradisional - Oven Industrial',
            'slug' => 'toko-roti-kue-tradisional',
            'description' => 'Alhamdulillah campaign sudah tercapai! Terima kasih para donatur. Oven industrial sudah dibeli dan produksi meningkat 3x lipat.',
            'target_amount' => 60000000,
            'current_amount' => 65000000,
            'deadline' => now()->subMonths(1),
            'image' => 'images/campaigns/Campaign11OvenIndustrial.jpeg',
            'status' => 'funded',
        ]);
    }
}