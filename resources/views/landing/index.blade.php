<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings['site_description'] ?? 'Solusi Teknologi Informasi Terpercaya' }}">
    <title>{{ $settings['site_name'] ?? 'PT Maju Bersama Teknologi' }} | {{ $settings['site_description'] ?? 'Solusi Digital Terkini' }}</title>


    <!-- Google Fonts - Modern & Trendy -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Sora:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'gradient': 'gradient 8s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background: #ffffff;
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glass Card - Minimalist */
        .glass {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .glass:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        /* Button */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 6px -1px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            box-shadow: 0 10px 15px -3px rgba(102, 126, 234, 0.4);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: #ffffff;
            border: 2px solid #e5e7eb;
        }

        .btn-outline:hover {
            background: #f9fafb;
            border-color: #667eea;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f3f4f6;
        }

        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
</head>

<body class="antialiased text-gray-800 overflow-x-hidden">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/95 backdrop-blur-sm border-b border-gray-100" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 cursor-pointer" onclick="window.scrollTo(0,0)">
                    <span class="font-display text-2xl font-bold text-gray-800">
                        {{ $settings['site_name'] ?? 'MajuTech' }} ✨
                    </span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-purple-600 transition font-medium">Beranda</a>
                    <a href="#services" class="text-gray-700 hover:text-purple-600 transition font-medium">Layanan</a>
                    <a href="#portfolio" class="text-gray-700 hover:text-purple-600 transition font-medium">Portfolio</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-purple-600 transition font-medium">Tentang</a>
                    <a href="#contact" class="btn-primary px-6 py-2.5 rounded-full text-white font-semibold transition">
                        Hubungi Kami 🚀
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-800 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-gray-100">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="#home" class="block px-3 py-2 text-gray-800 hover:bg-white/20 rounded-md">Beranda</a>
                <a href="#services" class="block px-3 py-2 text-gray-800 hover:bg-white/20 rounded-md">Layanan</a>
                <a href="#portfolio" class="block px-3 py-2 text-gray-800 hover:bg-white/20 rounded-md">Portfolio</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-800 hover:bg-white/20 rounded-md">Tentang</a>
                <a href="#contact" class="block px-3 py-2 text-purple-600 font-bold">Hubungi Kami</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center pt-20 px-4">
        <div class="relative z-10 text-center max-w-5xl mx-auto">
            <!-- Badge -->
            <div data-aos="fade-down" data-aos-duration="800">
                <span class="inline-flex items-center px-4 py-2 rounded-full glass text-sm font-semibold mb-6 text-gray-700">
                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span>
                    Solusi Digital Terpercaya 🎯
                </span>
            </div>

            <!-- Main Heading -->
            <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-bold leading-tight mb-6" data-aos="fade-up" data-aos-delay="200">
                Wujudkan Ide<br>
                <span class="gradient-text">Jadi Kenyataan</span>
            </h1>

            <!-- Description -->
            <p class="text-lg md:text-xl text-gray-700 max-w-2xl mx-auto leading-relaxed mb-10" data-aos="fade-up" data-aos-delay="400">
                {{ Str::limit($company->description ?? 'Kami membantu bisnis Anda berkembang dengan teknologi terkini dan strategi digital yang efektif. Mari ciptakan sesuatu yang luar biasa bersama!', 200) }}
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16" data-aos="fade-up" data-aos-delay="600">
                <a href="#contact" class="btn-primary px-8 py-4 rounded-full font-bold text-white transition transform hover:scale-105 inline-flex items-center justify-center gap-2">
                    Mulai Sekarang <i class="fas fa-rocket"></i>
                </a>
                <a href="#services" class="btn-outline px-8 py-4 rounded-full font-bold text-gray-800 transition inline-flex items-center justify-center gap-2">
                    Lihat Layanan <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-6 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="800">
                <div class="glass p-4 rounded-2xl">
                    <h3 class="text-3xl font-bold gradient-text">500+</h3>
                    <p class="text-sm text-gray-600 mt-1">Proyek Selesai</p>
                </div>
                <div class="glass p-4 rounded-2xl">
                    <h3 class="text-3xl font-bold gradient-text">98%</h3>
                    <p class="text-sm text-gray-600 mt-1">Klien Puas</p>
                </div>
                <div class="glass p-4 rounded-2xl">
                    <h3 class="text-3xl font-bold gradient-text">10+</h3>
                    <p class="text-sm text-gray-600 mt-1">Tahun Pengalaman</p>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-gray-700 text-2xl opacity-50"></i>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="font-display text-4xl md:text-5xl font-bold mb-4 text-gray-800">
                    Layanan <span class="gradient-text">Kami</span>
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Solusi lengkap untuk kebutuhan digital bisnis Anda
                </p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($services as $index => $service)
                    <a href="{{ route('service.detail', $service->id) }}" class="glass p-6 rounded-2xl transition-all duration-300 hover:scale-105 group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center mb-4 group-hover:rotate-12 transition-transform">
                            <i class="{{ $service->icon ?? 'fas fa-rocket' }} text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $service->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($service->description, 100) }}</p>
                        <span class="text-purple-600 text-sm font-semibold inline-flex items-center gap-2 group-hover:gap-3 transition-all">
                            Pelajari <i class="fas fa-arrow-right"></i>
                        </span>
                    </a>
                @empty
                    <div class="col-span-4 text-center glass p-10 rounded-2xl">
                        <p class="text-gray-500">Belum ada layanan yang ditambahkan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="font-display text-4xl md:text-5xl font-bold mb-4 text-gray-800">
                    Portfolio <span class="gradient-text">Terbaru</span>
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Karya-karya terbaik kami yang telah membantu klien mencapai kesuksesan
                </p>
            </div>

            <!-- Portfolio Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projects as $index => $project)
                    <a href="{{ route('portfolio.detail', $project->id) }}" class="group relative rounded-2xl overflow-hidden cursor-pointer" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <img src="{{ $project->image ? asset('storage/' . $project->image) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800' }}" 
                             alt="{{ $project->name }}" 
                             class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <h3 class="text-2xl font-bold mb-2 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform">{{ $project->name }}</h3>
                            <p class="text-white/90 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform delay-75">{{ Str::limit($project->description, 80) }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center glass p-10 rounded-2xl">
                        <p class="text-gray-500">Belum ada portfolio yang ditambahkan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-8 p-4 glass rounded-lg text-center text-green-700 font-semibold" data-aos="fade-down">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="glass rounded-3xl overflow-hidden p-8 md:p-12" data-aos="zoom-in">
                <div class="text-center mb-10">
                    <h2 class="font-display text-4xl md:text-5xl font-bold mb-4 text-gray-800">
                        Mari <span class="gradient-text">Berkolaborasi</span>
                    </h2>
                    <p class="text-gray-600 text-lg">
                        Punya proyek menarik? Yuk diskusi bareng! 💬
                    </p>
                </div>

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-purple-600">Nama</label>
                            <input type="text" name="name" required 
                                   class="w-full bg-white/50 border border-gray-300 rounded-xl px-4 py-3 text-gray-800 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 transition" 
                                   placeholder="Nama kamu">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-purple-600">Email</label>
                            <input type="email" name="email" required 
                                   class="w-full bg-white/50 border border-gray-300 rounded-xl px-4 py-3 text-gray-800 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 transition" 
                                   placeholder="email@example.com">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-purple-600">Pesan</label>
                        <textarea name="message" rows="4" required 
                                  class="w-full bg-white/50 border border-gray-300 rounded-xl px-4 py-3 text-gray-800 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 transition" 
                                  placeholder="Ceritakan tentang proyekmu..."></textarea>
                    </div>
                    <button type="submit" class="w-full btn-primary py-4 rounded-xl font-bold text-white transition transform hover:scale-105">
                        Kirim Pesan 🚀
                    </button>
                </form>

                <!-- Contact Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 pt-10 border-t border-gray-300">
                    <div class="text-center">
                        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-envelope text-purple-600"></i>
                        </div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-semibold text-gray-800">{{ $settings['contact_email'] ?? 'info@majubersamatek.co.id' }}</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-phone text-purple-600"></i>
                        </div>
                        <p class="text-sm text-gray-500">Telepon</p>
                        <p class="font-semibold text-gray-800">{{ $settings['contact_phone'] ?? '021-5551234' }}</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-map-marker-alt text-purple-600"></i>
                        </div>
                        <p class="text-sm text-gray-500">Lokasi</p>
                        <p class="font-semibold text-gray-800">{{ Str::limit($settings['address'] ?? 'Jakarta, Indonesia', 30) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 border-t border-gray-200 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <span class="font-display text-xl font-bold text-gray-800">{{ $settings['site_name'] ?? 'MajuTech' }} ✨</span>
                    <p class="text-gray-500 text-sm mt-1">&copy; {{ date('Y') }} All Rights Reserved</p>
                </div>
                <div class="flex space-x-6">
                    <a href="{{ $settings['instagram_url'] ?? '#' }}" class="text-gray-600 hover:text-purple-600 transition"><i class="fab fa-instagram text-xl"></i></a>
                    <a href="{{ $settings['linkedin_url'] ?? '#' }}" class="text-gray-600 hover:text-purple-600 transition"><i class="fab fa-linkedin text-xl"></i></a>
                    <a href="{{ $settings['facebook_url'] ?? '#' }}" class="text-gray-600 hover:text-purple-600 transition"><i class="fab fa-facebook text-xl"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            duration: 800,
            offset: 100,
        });

        // Mobile Menu Toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                menu.classList.add('hidden');
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar Background on Scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('glass');
            } else {
                navbar.classList.remove('glass');
            }
        });
    </script>
</body>

</html>
