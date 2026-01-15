<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();
        
        if ($employees->isEmpty()) {
            $this->command->warn('No employees found. Please run EmployeeSeeder first.');
            return;
        }

        $docTypes = ['ktp', 'npwp', 'cv', 'contract', 'certificate'];
        $documents = [];

        foreach ($employees as $employee) {
            // Add 2-3 documents per employee
            $types = array_rand(array_flip($docTypes), rand(2, 3));
            if (!is_array($types)) $types = [$types];

            foreach ($types as $type) {
                $documents[] = [
                    'employee_id' => $employee->id,
                    'document_type' => $type,
                    'document_name' => strtoupper($type) . ' - ' . $employee->first_name,
                    'file_path' => 'employees/' . $employee->id . '/' . $type . '.pdf',
                    'upload_date' => now(),
                    'notes' => 'Uploaded by system',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('employee_documents')->insert($documents);

        $this->command->info('Employee documents seeded successfully!');
    }
}
