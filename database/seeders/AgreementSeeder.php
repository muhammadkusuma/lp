<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agreement;
use App\Models\AgreementVersion;
use Carbon\Carbon;

class AgreementSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Agreement 1: Non-Profit Partnership
        $agreement1 = Agreement::create([
            'title' => 'Perjanjian Kerjasama dengan Yayasan Pendidikan',
            'agreement_number' => 'PKS/001/2026',
            'type' => 'non_profit',
            'party_name' => 'Yayasan Pendidikan Maju Bersama',
            'party_contact' => 'contact@yayasan.org',
            'start_date' => Carbon::parse('2026-01-01'),
            'end_date' => Carbon::parse('2026-12-31'),
            'status' => 'active',
            'description' => 'Kerjasama dalam bidang pengembangan teknologi pendidikan',
            'current_file_path' => 'agreements/1/PKS_001_2026_v1.pdf',
            'current_version' => 1,
        ]);

        AgreementVersion::create([
            'agreement_id' => $agreement1->id,
            'version_number' => 1,
            'file_path' => 'agreements/1/PKS_001_2026_v1.pdf',
            'notes' => 'Initial version',
            'uploaded_by' => null,
        ]);

        // Sample Agreement 2: Freelancer
        $agreement2 = Agreement::create([
            'title' => 'Kontrak Freelance Designer',
            'agreement_number' => 'FL/002/2026',
            'type' => 'freelancer',
            'party_name' => 'Ahmad Rizki',
            'party_contact' => 'ahmad@email.com',
            'start_date' => Carbon::parse('2026-01-15'),
            'end_date' => Carbon::parse('2026-04-15'),
            'status' => 'active',
            'description' => 'Kontrak freelance untuk desain UI/UX aplikasi',
            'current_file_path' => 'agreements/2/FL_002_2026_v1.pdf',
            'current_version' => 1,
        ]);

        AgreementVersion::create([
            'agreement_id' => $agreement2->id,
            'version_number' => 1,
            'file_path' => 'agreements/2/FL_002_2026_v1.pdf',
            'notes' => 'Initial version',
            'uploaded_by' => null,
        ]);

        // Sample Agreement 3: PKWT (expiring soon)
        $agreement3 = Agreement::create([
            'title' => 'PKWT Karyawan Developer',
            'agreement_number' => 'PKWT/003/2025',
            'type' => 'pkwt',
            'party_name' => 'Budi Santoso',
            'party_contact' => 'budi@email.com',
            'start_date' => Carbon::parse('2025-02-01'),
            'end_date' => Carbon::parse('2026-02-01'),
            'status' => 'active',
            'description' => 'Kontrak karyawan untuk posisi Senior Developer',
            'current_file_path' => 'agreements/3/PKWT_003_2025_v1.pdf',
            'current_version' => 1,
        ]);

        AgreementVersion::create([
            'agreement_id' => $agreement3->id,
            'version_number' => 1,
            'file_path' => 'agreements/3/PKWT_003_2025_v1.pdf',
            'notes' => 'Initial version',
            'uploaded_by' => null,
        ]);
    }
}
