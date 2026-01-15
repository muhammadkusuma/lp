<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'name' => 'PT Maju Bersama Teknologi',
            'legal_name' => 'PT Maju Bersama Teknologi',
            'address' => 'Jl. Gatot Subroto No. 88, Kuningan, Jakarta Selatan 12710',
            'phone' => '021-5551234',
            'email' => 'info@majubersamatek.co.id',
            'website' => 'https://www.majubersamatek.co.id',
            'description' => 'Perusahaan yang bergerak di bidang solusi teknologi informasi, pengembangan software, dan konsultasi IT untuk berbagai industri di Indonesia',
        ]);
    }
}
