<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lead;
use Carbon\Carbon;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $leads = [
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@email.com',
                'phone' => '081234567890',
                'company' => 'PT Startup Baru',
                'message' => 'Tertarik dengan layanan web development untuk company profile',
                'status' => 'new',
                'source' => 'website',
            ],
            [
                'name' => 'Siti Rahma',
                'email' => 'siti.rahma@email.com',
                'phone' => '081234567891',
                'company' => 'Toko Online Fashion',
                'message' => 'Butuh aplikasi mobile untuk toko online',
                'status' => 'contacted',
                'source' => 'referral',
            ],
            [
                'name' => 'Budi Hartono',
                'email' => 'budi.h@email.com',
                'phone' => '081234567892',
                'company' => 'Restoran Nusantara',
                'message' => 'Ingin konsultasi digital marketing',
                'status' => 'qualified',
                'source' => 'social_media',
            ],
        ];

        foreach ($leads as $lead) {
            Lead::create($lead);
        }
    }
}
