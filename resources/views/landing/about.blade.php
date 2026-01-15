<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tentang {{ $settings['site_name'] ?? 'PT Maju Bersama Teknologi' }}">
    <title>Tentang Kami | {{ $settings['site_name'] ?? 'PT Maju Bersama Teknologi' }}</title>

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
                Tentang <span class="gradient-text">Kami</span>
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed">
                {{ $settings['site_description'] ?? 'Solusi Teknologi Informasi Terpercaya untuk Bisnis Indonesia' }}
            </p>
        </div>
    </section>

    <!-- Company Info -->
    <section class="py-16 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white border border-gray-200 rounded-2xl p-8 md:p-12 mb-12">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Profil Perusahaan</h2>
                <div class="space-y-6 text-gray-700 leading-relaxed">
                    <p class="text-lg">
                        {{ $company->description ?? 'Kami adalah perusahaan teknologi yang berfokus pada pengembangan solusi digital untuk membantu bisnis berkembang di era digital.' }}
                    </p>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center">
                    <h3 class="text-4xl font-bold gradient-text mb-2">10+</h3>
                    <p class="text-gray-600">Tahun Pengalaman</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center">
                    <h3 class="text-4xl font-bold gradient-text mb-2">500+</h3>
                    <p class="text-gray-600">Proyek Selesai</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-2xl p-8 text-center">
                    <h3 class="text-4xl font-bold gradient-text mb-2">98%</h3>
                    <p class="text-gray-600">Kepuasan Klien</p>
                </div>
            </div>

            <!-- Visi Misi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <div class="bg-purple-50 border border-purple-100 rounded-2xl p-8">
                    <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-eye text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Visi</h3>
                    <p class="text-gray-700">
                        Menjadi mitra teknologi terpercaya yang membantu bisnis Indonesia bertransformasi digital dan berkembang pesat.
                    </p>
                </div>
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-8">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-bullseye text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Misi</h3>
                    <p class="text-gray-700">
                        Memberikan solusi teknologi berkualitas tinggi dengan layanan yang personal dan hasil yang terukur.
                    </p>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white border border-gray-200 rounded-2xl p-8 md:p-12">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">Hubungi Kami</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-3">
                            <i class="fas fa-envelope text-purple-600"></i>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Email</p>
                        <p class="font-semibold text-gray-800">{{ $settings['contact_email'] }}</p>
                    </div>
                    <div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-3">
                            <i class="fas fa-phone text-purple-600"></i>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Telepon</p>
                        <p class="font-semibold text-gray-800">{{ $settings['contact_phone'] }}</p>
                    </div>
                    <div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-3">
                            <i class="fas fa-map-marker-alt text-purple-600"></i>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Alamat</p>
                        <p class="font-semibold text-gray-800">{{ $settings['address'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl p-8 md:p-12 text-center text-white">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Siap Berkolaborasi?</h3>
                <p class="text-lg mb-8 text-white/90">Mari wujudkan project digital Anda bersama kami!</p>
                <a href="{{ route('home') }}#contact" class="inline-block bg-white text-purple-600 px-8 py-4 rounded-full font-bold hover:bg-gray-100 transition">
                    Hubungi Kami Sekarang <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
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
