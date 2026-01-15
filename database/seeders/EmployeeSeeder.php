<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // Owner/Director (Permanent)
        $owner = Employee::create([
            'employee_type' => 'owner',
            'full_name' => 'Muhammad Kusuma',
            'id_number' => '3201234567890001',
            'email' => 'owner@company.com',
            'phone' => '081234567890',
            'address' => 'Jakarta Selatan',
            'position' => 'Direktur Utama',
            'join_date' => Carbon::parse('2024-06-01'),
            'contract_start' => null,
            'contract_end' => null,
            'is_permanent' => true,
            'status' => 'active',
            'salary' => null,
            'notes' => 'Pemilik dan Direktur Utama perusahaan',
            'reminder_days' => 30,
        ]);

        // Freelancer (Active contract)
        $freelancer = Employee::create([
            'employee_type' => 'freelancer',
            'full_name' => 'Ahmad Rizki Pratama',
            'id_number' => '3201234567890002',
            'email' => 'ahmad.rizki@email.com',
            'phone' => '081234567891',
            'address' => 'Bandung',
            'position' => 'UI/UX Designer',
            'join_date' => Carbon::parse('2025-12-01'),
            'contract_start' => Carbon::parse('2025-12-01'),
            'contract_end' => Carbon::parse('2026-06-01'),
            'is_permanent' => false,
            'status' => 'active',
            'salary' => 15000000,
            'notes' => 'Freelance designer untuk proyek aplikasi mobile',
            'reminder_days' => 30,
        ]);

        // Contract Employee (Contract ending soon - 25 days)
        $contract1 = Employee::create([
            'employee_type' => 'contract',
            'full_name' => 'Budi Santoso',
            'id_number' => '3201234567890003',
            'email' => 'budi.santoso@email.com',
            'phone' => '081234567892',
            'address' => 'Jakarta Timur',
            'position' => 'Senior Developer',
            'join_date' => Carbon::parse('2025-02-01'),
            'contract_start' => Carbon::parse('2025-02-01'),
            'contract_end' => Carbon::now()->addDays(25),
            'is_permanent' => false,
            'status' => 'contract_ending',
            'salary' => 12000000,
            'notes' => 'PKWT 1 tahun, perlu direnew',
            'reminder_days' => 30,
        ]);

        // Contract Employee (Inactive - contract expired)
        $contract2 = Employee::create([
            'employee_type' => 'contract',
            'full_name' => 'Siti Nurhaliza',
            'id_number' => '3201234567890004',
            'email' => 'siti.nur@email.com',
            'phone' => '081234567893',
            'address' => 'Tangerang',
            'position' => 'Marketing Staff',
            'join_date' => Carbon::parse('2024-06-01'),
            'contract_start' => Carbon::parse('2024-06-01'),
            'contract_end' => Carbon::parse('2025-12-31'),
            'is_permanent' => false,
            'status' => 'inactive',
            'salary' => 8000000,
            'notes' => 'Kontrak sudah berakhir, tidak diperpanjang',
            'reminder_days' => 30,
        ]);

        // Sample documents for owner
        EmployeeDocument::create([
            'employee_id' => $owner->id,
            'document_type' => 'ktp',
            'document_name' => 'KTP Direktur Utama',
            'file_path' => 'employees/1/ktp_' . time() . '_KTP.jpg',
            'upload_date' => Carbon::now(),
            'notes' => 'KTP untuk keperluan administrasi',
        ]);

        EmployeeDocument::create([
            'employee_id' => $owner->id,
            'document_type' => 'npwp',
            'document_name' => 'NPWP Pribadi Direktur',
            'file_path' => 'employees/1/npwp_' . (time() + 1) . '_NPWP.pdf',
            'upload_date' => Carbon::now(),
            'notes' => 'NPWP untuk keperluan pajak',
        ]);

        // Sample documents for freelancer
        EmployeeDocument::create([
            'employee_id' => $freelancer->id,
            'document_type' => 'cv',
            'document_name' => 'CV Ahmad Rizki',
            'file_path' => 'employees/2/cv_' . (time() + 2) . '_CV.pdf',
            'upload_date' => Carbon::now(),
            'notes' => 'CV dan portfolio designer',
        ]);

        EmployeeDocument::create([
            'employee_id' => $freelancer->id,
            'document_type' => 'contract',
            'document_name' => 'Kontrak Freelance Designer',
            'file_path' => 'employees/2/contract_' . (time() + 3) . '_Kontrak.pdf',
            'upload_date' => Carbon::now(),
            'notes' => 'Kontrak kerja freelance 6 bulan',
        ]);
    }
}
