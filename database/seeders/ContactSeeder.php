<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'name' => 'Andi Wijaya',
                'email' => 'andi.wijaya@example.com',
                'message' => 'Saya tertarik untuk membuat website company profile untuk perusahaan kami. Mohon informasi lebih lanjut mengenai harga dan timeline pengerjaan.',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'name' => 'Sari Kusuma',
                'email' => 'sari.kusuma@example.com',
                'message' => 'Kami membutuhkan aplikasi mobile untuk toko online kami. Apakah bisa konsultasi terlebih dahulu?',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'message' => 'Perusahaan kami memerlukan sistem inventory management. Mohon hubungi saya untuk diskusi lebih lanjut.',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@example.com',
                'message' => 'Halo, saya ingin bertanya tentang layanan maintenance website. Apakah ada paket bulanan?',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'name' => 'Rudi Hartono',
                'email' => 'rudi.hartono@example.com',
                'message' => 'Kami tertarik dengan portfolio yang ditampilkan. Bisakah kami mendapatkan quotation untuk project serupa?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('contacts')->insert($contacts);

        $this->command->info('Contacts seeded successfully!');
    }
}
