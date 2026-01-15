<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'client_name' => 'Budi Santoso', // Changed from name to client_name
                'content' => 'Pelayanan yang sangat profesional dan hasil yang memuaskan. Tim sangat responsif dan memahami kebutuhan bisnis kami. Highly recommended!',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'client_name' => 'Siti Nurhaliza',
                'content' => 'Website yang dibuat sangat modern dan user-friendly. Conversion rate kami meningkat 40% setelah menggunakan website baru. Terima kasih!',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'client_name' => 'Ahmad Rizki',
                'content' => 'Aplikasi mobile yang dikembangkan sangat membantu bisnis kami. Fitur-fiturnya lengkap dan mudah digunakan oleh customer.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'client_name' => 'Linda Wijaya',
                'content' => 'Sistem yang dibangun sangat robust dan scalable. Support team juga sangat helpful dalam maintenance.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'client_name' => 'Dedi Kurniawan',
                'content' => 'Kerjasama yang baik dari awal hingga deployment. Dokumentasi lengkap dan training yang diberikan sangat membantu tim kami.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('testimonials')->insert($testimonials);

        $this->command->info('Testimonials seeded successfully!');
    }
}
