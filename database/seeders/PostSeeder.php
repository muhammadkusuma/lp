<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::first();
        
        if (!$author) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }

        $posts = [
            [
                'author_id' => $author->id,
                'title' => 'Panduan Memilih Teknologi Web Development di 2026',
                'slug' => 'panduan-memilih-teknologi-web-development-2026',
                'content' => "Memilih teknologi yang tepat untuk proyek web development sangat penting untuk kesuksesan jangka panjang. Dalam artikel ini, kami akan membahas berbagai framework dan tools yang populer di tahun 2026.\n\nLaravel tetap menjadi pilihan utama untuk backend development dengan ekosistem yang matang dan komunitas yang besar. Untuk frontend, React dan Vue.js masih mendominasi pasar.\n\nPertimbangkan juga faktor seperti skalabilitas, maintainability, dan ketersediaan developer ketika memilih stack teknologi untuk proyek Anda.",
                'status' => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'author_id' => $author->id,
                'title' => 'Tips Optimasi Performa Website untuk Meningkatkan Conversion',
                'slug' => 'tips-optimasi-performa-website',
                'content' => "Performa website yang lambat dapat mengurangi conversion rate hingga 50%. Berikut adalah tips untuk mengoptimalkan performa website Anda:\n\n1. Gunakan CDN untuk mempercepat loading asset\n2. Optimalkan gambar dengan format WebP\n3. Implementasi lazy loading untuk gambar dan video\n4. Minify CSS dan JavaScript\n5. Gunakan caching yang efektif\n\nDengan menerapkan tips di atas, Anda dapat meningkatkan kecepatan website hingga 3x lebih cepat.",
                'status' => 'published',
                'published_at' => now()->subDays(14),
            ],
            [
                'author_id' => $author->id,
                'title' => 'Keamanan Aplikasi Web: Best Practices yang Harus Diterapkan',
                'slug' => 'keamanan-aplikasi-web-best-practices',
                'content' => "Keamanan adalah aspek krusial dalam pengembangan aplikasi web. Berikut adalah best practices yang harus diterapkan:\n\n- Selalu validasi input dari user\n- Gunakan prepared statements untuk mencegah SQL injection\n- Implementasi HTTPS di seluruh website\n- Gunakan CSRF protection\n- Hash password dengan algoritma yang kuat (bcrypt, argon2)\n- Implementasi rate limiting untuk API\n- Regular security audit dan penetration testing\n\nJangan pernah mengabaikan aspek keamanan dalam development process.",
                'status' => 'published',
                'published_at' => now()->subDays(21),
            ],
            [
                'author_id' => $author->id,
                'title' => 'Tren Mobile App Development 2026',
                'slug' => 'tren-mobile-app-development-2026',
                'content' => "Industri mobile app development terus berkembang pesat. Berikut adalah tren yang akan mendominasi di tahun 2026:\n\n1. Cross-platform development dengan Flutter dan React Native\n2. AI dan Machine Learning integration\n3. Augmented Reality (AR) features\n4. 5G optimization\n5. Progressive Web Apps (PWA)\n\nPerusahaan yang mengadopsi teknologi ini akan memiliki competitive advantage di pasar.",
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'author_id' => $author->id,
                'title' => 'Cara Membangun API RESTful yang Scalable',
                'slug' => 'membangun-api-restful-scalable',
                'content' => "API yang baik adalah fondasi dari aplikasi modern. Artikel ini akan membahas cara membangun API RESTful yang scalable dan maintainable.\n\nPrinsip-prinsip penting:\n- Gunakan HTTP methods dengan benar (GET, POST, PUT, DELETE)\n- Implementasi versioning untuk backward compatibility\n- Dokumentasi yang lengkap dengan Swagger/OpenAPI\n- Rate limiting dan authentication\n- Error handling yang konsisten\n- Caching strategy yang efektif\n\nDengan mengikuti best practices ini, API Anda akan mudah di-maintain dan di-scale.",
                'status' => 'draft',
                'published_at' => null,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }

        $this->command->info('Posts seeded successfully!');
    }
}
