<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyLegal;

class CompanyLegalSeeder extends Seeder
{
    public function run(): void
    {
        $company = \App\Models\Company::first();
        
        CompanyLegal::create([
            'company_id' => $company->id,
            'npwp' => '12.345.678.9-012.000',
            'nib' => '1234567890123',
            'akta_pendirian' => 'AHU-0012345.AH.01.01.TAHUN 2024',
            'tanggal_pendirian' => '2024-06-15',
        ]);
    }
}
