<?php

namespace Database\Seeders;

use App\Models\Agreement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgreementVersionSeeder extends Seeder
{
    public function run(): void
    {
        $agreements = Agreement::all();
        $users = User::all();
        
        if ($agreements->isEmpty()) {
            $this->command->warn('No agreements found. Please run AgreementSeeder first.');
            return;
        }

        $versions = [];

        foreach ($agreements as $agreement) {
            // Create 1-3 versions per agreement
            $versionCount = rand(1, 3);
            
            for ($i = 1; $i <= $versionCount; $i++) {
                $versions[] = [
                    'agreement_id' => $agreement->id,
                    'version_number' => $i,
                    'file_path' => 'agreements/' . $agreement->id . '/v' . $i . '.pdf',
                    'notes' => $i === 1 ? 'Initial draft' : ($i === $versionCount ? 'Final version' : 'Revision ' . ($i - 1)),
                    'uploaded_by' => $users->isNotEmpty() ? $users->random()->id : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('agreement_versions')->insert($versions);

        $this->command->info('Agreement versions seeded successfully!');
    }
}
