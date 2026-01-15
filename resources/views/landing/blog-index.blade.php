<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"="width=device-width, initial-scale=1.0">
    <meta name="description" content="Artikel dan Berita dari {{ $settings['site_name'] ?? 'PT Maju Bersama Teknologi' }}">
    <title>Artikel & Berita | {{ $settings['site_name'] ?? 'PT Maju Bersama Teknologi' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Sora:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Sora', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body {
            background: #ffffff;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="antialiased text-gray-800">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="{{ route('home') }}" class="font-display text-2xl font-bold text-gray-800">
                    {{ $settings['site_name'] ?? 'MajuTech' }} ✨
                </a>
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-purple-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-16 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="font-display text-4xl md:text-6xl font-bold mb-6 text-gray-800">
                Artikel & <span class="gradient-text">Berita</span>
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed">
                Informasi terkini seputar teknologi, tips, dan insight dari tim kami
            </p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="py-16 px-4">
        <div class="max-w-7xl mx-auto">
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    @foreach($posts as $post)
                        <a href="{{ route('blog.detail', $post->slug) }}" class="group bg-white rounded-2xl overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300">
                            <div class="aspect-video bg-gradient-to-br from-purple-100 to-blue-100 flex items-center justify-center">
                                <i class="fas fa-newspaper text-6xl text-purple-300"></i>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $post->published_at->format('d M Y') }}</span>
                                </div>
                                <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-purple-600 transition line-clamp-2">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                                <span class="text-purple-600 text-sm font-semibold inline-flex items-center gap-2 group-hover:gap-3 transition-all">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($posts->hasPages())
                    <div class="flex justify-center">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-20">
                    <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">Belum ada artikel yang dipublikasikan</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 border-t border-gray-200 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'MajuTech' }}. All Rights Reserved</p>
        </div>
    </footer>

</body>

</html>
