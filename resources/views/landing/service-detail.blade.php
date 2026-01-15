<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $service->description }}">
    <title>{{ $service->name }} | {{ $settings['site_name'] ?? 'PT Maju Bersama Teknologi' }}</title>

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
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center mx-auto mb-6">
                <i class="{{ $service->icon ?? 'fas fa-rocket' }} text-4xl text-white"></i>
            </div>
            <h1 class="font-display text-4xl md:text-5xl font-bold mb-6 text-gray-800">
                {{ $service->name }}
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed">
                {{ $service->description }}
            </p>
        </div>
    </section>

    <!-- Detail Section -->
    <section class="py-16 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white border border-gray-200 rounded-2xl p-8 md:p-12 mb-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Detail Layanan</h2>
                
                @if($service->price_start)
                <div class="mb-8 p-6 bg-purple-50 rounded-xl border border-purple-100">
                    <p class="text-sm text-gray-600 mb-1">Harga Mulai Dari</p>
                    <p class="text-3xl font-bold gradient-text">
                        Rp {{ number_format($service->price_start, 0, ',', '.') }}
                    </p>
                </div>
                @endif

                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-700 leading-relaxed">
                        {{ $service->description }}
                    </p>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl p-8 md:p-12 text-center text-white">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Tertarik dengan Layanan Ini?</h3>
                <p class="text-lg mb-8 text-white/90">Mari diskusikan kebutuhan Anda dengan tim kami!</p>
                <a href="{{ route('home') }}#contact" class="inline-block bg-white text-purple-600 px-8 py-4 rounded-full font-bold hover:bg-gray-100 transition">
                    Hubungi Kami Sekarang <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Related Services -->
    @if($relatedServices->count() > 0)
    <section class="py-16 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Layanan Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedServices as $related)
                <a href="{{ route('service.detail', $related->id) }}" class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition group">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <i class="{{ $related->icon ?? 'fas fa-rocket' }} text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $related->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ Str::limit($related->description, 100) }}</p>
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
