<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ Str::limit(strip_tags($post->content), 160) }}">
    <title>{{ $post->title }} | {{ $settings['site_name'] ?? 'PT Maju Bersama Teknologi' }}</title>

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

        .prose {
            max-width: none;
        }

        .prose p {
            margin-bottom: 1.25em;
            line-height: 1.75;
        }

        .prose h2 {
            font-size: 1.5em;
            font-weight: 700;
            margin-top: 2em;
            margin-bottom: 1em;
        }

        .prose h3 {
            font-size: 1.25em;
            font-weight: 600;
            margin-top: 1.6em;
            margin-bottom: 0.6em;
        }

        .prose ul, .prose ol {
            margin: 1.25em 0;
            padding-left: 1.625em;
        }

        .prose li {
            margin: 0.5em 0;
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
                <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-purple-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <!-- Article Header -->
    <section class="pt-32 pb-16 px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="font-display text-4xl md:text-5xl font-bold mb-6 text-gray-800">
                {{ $post->title }}
            </h1>
            
            <div class="flex items-center gap-4 text-gray-600 mb-8">
                <div class="flex items-center gap-2">
                    <i class="fas fa-calendar"></i>
                    <span>{{ $post->published_at->format('d F Y') }}</span>
                </div>
                @if($post->author)
                <div class="flex items-center gap-2">
                    <i class="fas fa-user"></i>
                    <span>{{ $post->author->name }}</span>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="pb-16 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="prose prose-lg text-gray-700">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    @if($relatedPosts->count() > 0)
    <section class="py-16 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Artikel Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPosts as $related)
                <a href="{{ route('blog.detail', $related->slug) }}" class="group bg-white rounded-2xl overflow-hidden border border-gray-200 hover:shadow-lg transition">
                    <div class="aspect-video bg-gradient-to-br from-purple-100 to-blue-100 flex items-center justify-center">
                        <i class="fas fa-newspaper text-4xl text-purple-300"></i>
                    </div>
                    <div class="p-4">
                        <p class="text-sm text-gray-500 mb-2">{{ $related->published_at->format('d M Y') }}</p>
                        <h3 class="text-lg font-bold text-gray-800 group-hover:text-purple-600 transition line-clamp-2">{{ $related->title }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="py-8 border-t border-gray-200 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'MajuTech' }}. All Rights Reserved</p>
        </div>
    </footer>

</body>

</html>
