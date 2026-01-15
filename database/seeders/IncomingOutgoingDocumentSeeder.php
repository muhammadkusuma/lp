<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use Carbon\Carbon;

class IncomingOutgoingDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            // Incoming Documents
            [
                'document_number' => 'IN/2026/01/0001',
                'direction' => 'incoming',
                'title' => 'Surat Undangan Rapat Koordinasi',
                'classification' => 'umum',
                'sender' => 'PT Mitra Sejahtera',
                'recipient' => null,
                'document_date' => Carbon::parse('2026-01-10'),
                'received_date' => Carbon::parse('2026-01-10'),
                'sent_date' => null,
                'description' => 'Undangan rapat koordinasi proyek bersama',
                'file_path' => 'documents/incoming/2026/01/IN_2026_01_0001_Undangan.pdf',
                'keywords' => 'rapat, koordinasi, undangan',
                'status' => 'processed',
            ],
            [
                'document_number' => 'IN/2026/01/0002',
                'direction' => 'incoming',
                'title' => 'Invoice dari Vendor',
                'classification' => 'keuangan',
                'sender' => 'CV Supplier Teknologi',
                'recipient' => null,
                'document_date' => Carbon::parse('2026-01-12'),
                'received_date' => Carbon::parse('2026-01-12'),
                'sent_date' => null,
                'description' => 'Invoice pembelian perangkat komputer',
                'file_path' => 'documents/incoming/2026/01/IN_2026_01_0002_Invoice.pdf',
                'keywords' => 'invoice, pembelian, vendor',
                'status' => 'processed',
            ],
            
            // Outgoing Documents
            [
                'document_number' => 'OUT/2026/01/0001',
                'direction' => 'outgoing',
                'title' => 'Surat Penawaran Kerjasama',
                'classification' => 'operasional',
                'sender' => null,
                'recipient' => 'PT Klien Potensial',
                'document_date' => Carbon::parse('2026-01-14'),
                'received_date' => null,
                'sent_date' => Carbon::parse('2026-01-14'),
                'description' => 'Penawaran kerjasama pengembangan sistem',
                'file_path' => 'documents/outgoing/2026/01/OUT_2026_01_0001_Penawaran.pdf',
                'keywords' => 'penawaran, kerjasama, proposal',
                'status' => 'processed',
            ],
            [
                'document_number' => 'OUT/2026/01/0002',
                'direction' => 'outgoing',
                'title' => 'Laporan Bulanan ke Stakeholder',
                'classification' => 'operasional',
                'sender' => null,
                'recipient' => 'Dewan Komisaris',
                'document_date' => Carbon::parse('2026-01-15'),
                'received_date' => null,
                'sent_date' => Carbon::parse('2026-01-15'),
                'description' => 'Laporan progress dan keuangan bulan Desember 2025',
                'file_path' => 'documents/outgoing/2026/01/OUT_2026_01_0002_Laporan.pdf',
                'keywords' => 'laporan, bulanan, progress',
                'status' => 'processed',
            ],
        ];

        foreach ($documents as $doc) {
            Document::create($doc);
        }
    }
}
