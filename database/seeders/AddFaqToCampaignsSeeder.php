<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;

class AddFaqToCampaignsSeeder extends Seeder
{
    public function run()
    {
        $campaigns = Campaign::whereNull('faq_goal')->get();
        
        foreach ($campaigns as $campaign) {
            $campaign->update([
                'faq_goal' => 'Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',
                'faq_fund_usage' => 'Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.',
                'faq_timeline' => 'Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',
            ]);
        }
        
        $this->command->info('Added FAQ to ' . $campaigns->count() . ' campaigns!');
    }
}