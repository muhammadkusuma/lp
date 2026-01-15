<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentTemplate;

class DocumentTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Template Surat Resmi Perusahaan',
                'type' => 'surat_resmi',
                'description' => 'Template untuk surat resmi perusahaan dengan kop surat',
                'file_path' => 'document-templates/surat_resmi_template.docx',
                'status' => 'active',
            ],
            [
                'name' => 'Template Perjanjian Kerjasama',
                'type' => 'perjanjian_kontrak',
                'description' => 'Template standar perjanjian kerjasama dengan mitra',
                'file_path' => 'document-templates/perjanjian_template.docx',
                'status' => 'active',
            ],
            [
                'name' => 'Template Memo Internal',
                'type' => 'memo_internal',
                'description' => 'Template memo untuk komunikasi internal',
                'file_path' => 'document-templates/memo_template.docx',
                'status' => 'active',
            ],
            [
                'name' => 'Template Surat Kuasa',
                'type' => 'dokumen_legal',
                'description' => 'Template surat kuasa untuk keperluan legal',
                'file_path' => 'document-templates/surat_kuasa_template.docx',
                'status' => 'active',
            ],
        ];

        foreach ($templates as $template) {
            DocumentTemplate::create($template);
        }
    }
}
