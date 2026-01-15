<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $project->description }}">
    <title>{{ $project->name }} | {{ $settings['site_name'] ?? 'PT Maju Bersama Teknologi' }}</title>

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
                <a href="{{ route('home') }}#portfolio" class="text-gray-600 hover:text-purple-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Image -->
    <section class="pt-20">
        <div class="w-full h-96 bg-gray-100 overflow-hidden">
            @if($project->image)
            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}" class="w-full h-full object-cover">
            @else
            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200" alt="{{ $project->name }}" class="w-full h-full object-cover">
            @endif
        </div>
    </section>

    <!-- Project Info -->
    <section class="py-16 px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="font-display text-4xl md:text-5xl font-bold mb-6 text-gray-800">
                {{ $project->name }}
            </h1>
            
            <div class="flex flex-wrap gap-4 mb-8">
                <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">
                    <i class="fas fa-calendar mr-2"></i>{{ $project->created_at->format('M Y') }}
                </span>
            </div>

            <div class="prose prose-lg max-w-none mb-12">
                <p class="text-gray-700 text-lg leading-relaxed">
                    {{ $project->description }}
                </p>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl p-8 md:p-12 text-center text-white">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Punya Project Serupa?</h3>
                <p class="text-lg mb-8 text-white/90">Mari wujudkan project Anda bersama kami!</p>
                <a href="{{ route('home') }}#contact" class="inline-block bg-white text-purple-600 px-8 py-4 rounded-full font-bold hover:bg-gray-100 transition">
                    Mulai Project Anda <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Related Projects -->
    @if($relatedProjects->count() > 0)
    <section class="py-16 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Project Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProjects as $related)
                <a href="{{ route('portfolio.detail', $related->id) }}" class="group">
                    <div class="rounded-2xl overflow-hidden mb-4">
                        <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800' }}" 
                             alt="{{ $related->name }}" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-purple-600 transition">{{ $related->name }}</h3>
                    <p class="text-gray-600 text-sm mt-2">{{ Str::limit($related->description, 80) }}</p>
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
