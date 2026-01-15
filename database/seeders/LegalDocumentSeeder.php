<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LegalDocument;
use Carbon\Carbon;

class LegalDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            // Permanent Document
            [
                'document_type' => 'akta_pendirian',
                'document_number' => 'AHU-0012345.AH.01.01.TAHUN 2024',
                'document_name' => 'Akta Pendirian PT Perseorangan',
                'issuer' => 'Kementerian Hukum dan HAM',
                'issue_date' => Carbon::parse('2024-06-15'),
                'expiry_date' => null,
                'is_permanent' => true,
                'file_path' => 'legal-documents/akta_pendirian/akta_pendirian_AHU-0012345_Akta.pdf',
                'notes' => 'Dokumen pendirian perusahaan',
                'status' => 'active',
                'reminder_days' => 30,
            ],
            
            // NPWP (active)
            [
                'document_type' => 'npwp',
                'document_number' => '12.345.678.9-012.000',
                'document_name' => 'NPWP Perusahaan',
                'issuer' => 'Direktorat Jenderal Pajak',
                'issue_date' => Carbon::parse('2024-07-01'),
                'expiry_date' => Carbon::parse('2027-07-01'),
                'is_permanent' => false,
                'file_path' => 'legal-documents/npwp/npwp_12345678901_NPWP.pdf',
                'notes' => 'NPWP untuk keperluan perpajakan perusahaan',
                'status' => 'active',
                'reminder_days' => 90,
            ],
            
            // NIB (expiring soon - 20 days)
            [
                'document_type' => 'nib',
                'document_number' => '1234567890123',
                'document_name' => 'Nomor Induk Berusaha',
                'issuer' => 'OSS (Online Single Submission)',
                'issue_date' => Carbon::parse('2024-08-01'),
                'expiry_date' => Carbon::now()->addDays(20),
                'is_permanent' => false,
                'file_path' => 'legal-documents/nib/nib_1234567890123_NIB.pdf',
                'notes' => 'NIB untuk izin usaha',
                'status' => 'pending_renewal',
                'reminder_days' => 30,
            ],
            
            // SIUP (expired)
            [
                'document_type' => 'siup',
                'document_number' => 'SIUP/123/2024',
                'document_name' => 'Surat Izin Usaha Perdagangan',
                'issuer' => 'Dinas Penanaman Modal dan PTSP',
                'issue_date' => Carbon::parse('2024-01-15'),
                'expiry_date' => Carbon::parse('2025-12-31'),
                'is_permanent' => false,
                'file_path' => 'legal-documents/siup/siup_SIUP-123-2024_SIUP.pdf',
                'notes' => 'SIUP perlu diperpanjang segera',
                'status' => 'expired',
                'reminder_days' => 30,
            ],
        ];

        foreach ($documents as $doc) {
            LegalDocument::create($doc);
        }
    }
}
