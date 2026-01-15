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
            // Core Data (No dependencies)
            RoleSeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
            CompanyLegalSeeder::class,
            SettingSeeder::class,
            
            // Business Data (Depends on core)
            ServiceSeeder::class,
            ServicePackageSeeder::class, // Depends on services
            ClientSeeder::class,
            LeadSeeder::class,
            ContactSeeder::class, // Contact form submissions
            
            // Projects & Finance (Depends on clients)
            ProjectSeeder::class, // Depends on clients
            InvoiceSeeder::class, // Depends on clients & projects
            InvoiceItemSeeder::class, // Depends on invoices
            PaymentSeeder::class, // Depends on invoices
            
            // Content Management (Depends on users)
            CategorySeeder::class,
            PostSeeder::class, // Depends on users (author)
            PostCategorySeeder::class, // Depends on posts & categories
            TestimonialSeeder::class,
            PortfolioSeeder::class, // Portfolio table from testimonials migration
            
            // Document Management
            DocumentTemplateSeeder::class,
            AgreementSeeder::class,
            AgreementVersionSeeder::class, // Depends on agreements
            IncomingOutgoingDocumentSeeder::class,
            LegalDocumentSeeder::class,
            
            // HR Management
            EmployeeSeeder::class,
            EmployeeDocumentSeeder::class, // Depends on employees
        ]);

        $this->command->info('All seeders completed successfully!');
    }
}
