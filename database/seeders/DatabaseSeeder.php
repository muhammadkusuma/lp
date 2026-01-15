<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Core Data
            RoleSeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
            CompanyLegalSeeder::class,
            SettingSeeder::class,
            
            // Business Data
            ServiceSeeder::class,
            ClientSeeder::class,
            LeadSeeder::class,
            
            // Document Management
            DocumentTemplateSeeder::class,
            AgreementSeeder::class,
            IncomingOutgoingDocumentSeeder::class,
            LegalDocumentSeeder::class,
            
            // HR Management
            EmployeeSeeder::class,
        ]);
    }
}
