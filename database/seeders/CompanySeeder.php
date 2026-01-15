<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'name' => 'PT Perseorangan Digital Solutions',
            'legal_name' => 'PT Perseorangan Digital Solutions',
            'address' => 'Jl. Sudirman No. 123, Jakarta Selatan 12190',
            'phone' => '021-12345678',
            'email' => 'info@ptperseorangan.com',
            'website' => 'https://www.ptperseorangan.com',
            'description' => 'Perusahaan yang bergerak di bidang solusi digital dan pengembangan software',
        ]);
    }
}
