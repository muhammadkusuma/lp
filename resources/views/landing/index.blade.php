<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $company->name ?? 'Perusahaan Exclusive' }} | Solusi Premium</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'], // Mengganti Inter dengan Outfit agar lebih modern
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        gold: {
                            100: '#F9F1D8',
                            300: '#E6CB7D',
                            400: '#D4AF37',
                            500: '#AA8C2C',
                            glow: 'rgba(212, 175, 55, 0.5)',
                        },
                        dark: {
                            950: '#020202', // Lebih gelap dari hitam biasa
                            900: '#0a0a0a',
                            800: '#121212',
                        }
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                        'shine': 'shine 3s infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': {
                                transform: 'translate(0px, 0px) scale(1)'
                            },
                            '33%': {
                                transform: 'translate(30px, -50px) scale(1.1)'
                            },
                            '66%': {
                                transform: 'translate(-20px, 20px) scale(0.9)'
                            },
                            '100%': {
                                transform: 'translate(0px, 0px) scale(1)'
                            },
                        },
                        shine: {
                            '0%': {
                                backgroundPosition: '200% center'
                            },
                            '100%': {
                                backgroundPosition: '-200% center'
                            },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #020202;
            color: #e2e8f0;
            overflow-x: hidden;
        }

        /* Mewah Text Gradient */
        .text-gold-gradient {
            background: linear-gradient(to right, #bf953f, #fcf6ba, #b38728, #fbf5b7, #aa771c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% auto;
            animation: shine 4s linear infinite;
        }

        /* Glassmorphism Advanced */
        .glass-card {
            background: rgba(20, 20, 20, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .glass-card:hover {
            background: rgba(30, 30, 30, 0.6);
            border-color: rgba(212, 175, 55, 0.3);
            /* Gold border on hover */
            box-shadow: 0 0 25px rgba(212, 175, 55, 0.15);
            /* Gold glow */
            transform: translateY(-5px);
        }

        .glass-nav {
            background: rgba(2, 2, 2, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Button Glow Effect */
        .btn-gold {
            background: linear-gradient(135deg, #D4AF37 0%, #AA8C2C 100%);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-gold::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #F0DEAA 0%, #D4AF37 100%);
            opacity: 0;
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .btn-gold:hover::before {
            opacity: 1;
        }

        .btn-gold:hover {
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.6);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0a0a0a;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #D4AF37;
        }
    </style>
</head>

<body class="antialiased selection:bg-gold-400 selection:text-black">

    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div
            class="absolute top-0 left-1/4 w-96 h-96 bg-gold-500/10 rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob">
        </div>
        <div
            class="absolute top-0 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full mix-blend-screen filter blur-[100px] opacity-20 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-32 left-1/3 w-96 h-96 bg-gold-600/10 rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob animation-delay-4000">
        </div>
    </div>

    <nav class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex-shrink-0 cursor-pointer" onclick="window.scrollTo(0,0)">
                    <span class="font-serif text-2xl font-bold text-white tracking-wider">
                        LUX<span class="text-gold-400">CORP</span>
                    </span>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-8">
                        <a href="#home"
                            class="text-sm font-medium text-gray-300 hover:text-gold-400 transition relative group">
                            Beranda
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gold-400 transition-all group-hover:w-full"></span>
                        </a>
                        <a href="#about"
                            class="text-sm font-medium text-gray-300 hover:text-gold-400 transition relative group">
                            Tentang
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gold-400 transition-all group-hover:w-full"></span>
                        </a>
                        <a href="#services"
                            class="text-sm font-medium text-gray-300 hover:text-gold-400 transition relative group">
                            Layanan
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gold-400 transition-all group-hover:w-full"></span>
                        </a>
                        <a href="#portfolio"
                            class="text-sm font-medium text-gray-300 hover:text-gold-400 transition relative group">
                            Karya
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gold-400 transition-all group-hover:w-full"></span>
                        </a>
                        <a href="#contact"
                            class="btn-gold px-6 py-2.5 rounded-full text-black font-semibold text-sm transition transform hover:scale-105">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-gold-400 hover:text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-dark-900 border-b border-white/10 absolute w-full">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="#home"
                    class="block px-3 py-2 text-base font-medium text-gray-300 hover:text-gold-400 hover:bg-white/5 rounded-md">Beranda</a>
                <a href="#services"
                    class="block px-3 py-2 text-base font-medium text-gray-300 hover:text-gold-400 hover:bg-white/5 rounded-md">Layanan</a>
                <a href="#portfolio"
                    class="block px-3 py-2 text-base font-medium text-gray-300 hover:text-gold-400 hover:bg-white/5 rounded-md">Karya</a>
                <a href="#contact" class="block px-3 py-2 text-base font-medium text-gold-400 font-bold">Hubungi
                    Kami</a>
            </div>
        </div>
    </nav>

    <section id="home" class="relative min-h-screen flex items-center justify-center pt-20">
        <div class="absolute inset-0 z-0">
            <img src="{{ isset($company->hero_image) ? asset('storage/' . $company->hero_image) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80' }}"
                alt="Background" class="w-full h-full object-cover opacity-30 fixed top-0 left-0" style="z-index: -1;">
            <div class="absolute inset-0 bg-gradient-to-t from-dark-950 via-dark-950/90 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-dark-950/80 via-transparent to-dark-950/80"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
            <div data-aos="fade-down" data-aos-duration="1000">
                <span
                    class="inline-flex items-center py-1 px-4 rounded-full bg-gold-400/10 border border-gold-400/30 text-gold-300 text-xs font-bold tracking-[0.2em] uppercase mb-8 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-gold-400 mr-2 animate-pulse"></span>
                    Premium Business Solution
                </span>
            </div>

            <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl font-bold leading-tight mb-6" data-aos="fade-up"
                data-aos-delay="200">
                {{ $company->tagline ?? 'Elevate Your' }} <br>
                <span class="text-gold-gradient italic pr-2">Future Legacy</span>
            </h1>

            <p class="mt-6 text-lg md:text-xl text-gray-400 font-light max-w-2xl mx-auto leading-relaxed"
                data-aos="fade-up" data-aos-delay="400">
                {{ Str::limit($company->description ?? 'Kami mengubah visi ambisius menjadi realitas strategis dengan sentuhan elegan dan teknologi modern.', 160) }}
            </p>

            <div class="mt-12 flex flex-col md:flex-row gap-5 justify-center" data-aos="fade-up" data-aos-delay="600">
                <a href="#contact"
                    class="btn-gold px-10 py-4 rounded-full font-bold tracking-wide shadow-lg hover:shadow-gold-400/50 transition transform hover:-translate-y-1">
                    Mulai Konsultasi
                </a>
                <a href="#services"
                    class="px-10 py-4 rounded-full border border-white/20 text-white hover:bg-white/10 hover:border-white/40 transition backdrop-blur-sm flex items-center justify-center gap-2 group">
                    Pelajari Layanan <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div
                class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce opacity-50 hidden md:block">
                <i class="fas fa-chevron-down text-white text-xl"></i>
            </div>
        </div>
    </section>

    <section class="py-10 border-y border-white/5 bg-white/[0.02]">
        <div class="max-w-7xl mx-auto px-4 overflow-hidden">
            <p class="text-center text-gray-500 text-xs uppercase tracking-widest mb-6">Dipercaya oleh Perusahaan
                Terkemuka</p>
            <div
                class="flex flex-wrap justify-center gap-12 md:gap-20 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                <i class="fab fa-amazon text-4xl hover:text-white transition"></i>
                <i class="fab fa-google text-4xl hover:text-white transition"></i>
                <i class="fab fa-microsoft text-4xl hover:text-white transition"></i>
                <i class="fab fa-spotify text-4xl hover:text-white transition"></i>
                <i class="fab fa-airbnb text-4xl hover:text-white transition"></i>
            </div>
        </div>
    </section>

    <section id="services" class="py-32 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16" data-aos="fade-right">
                <div>
                    <h2 class="font-serif text-4xl md:text-5xl text-white mb-4">Layanan <span
                            class="text-gold-gradient">Eksklusif</span></h2>
                    <p class="text-gray-400 max-w-lg font-light border-l-2 border-gold-400 pl-4">
                        Kami merancang solusi spesifik untuk setiap tantangan bisnis Anda.
                    </p>
                </div>
                <a href="#contact"
                    class="hidden md:inline-block text-gold-400 hover:text-white transition pb-1 border-b border-gold-400/50 hover:border-white">
                    Diskusikan Kebutuhan Anda <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($services as $index => $service)
                    <div class="glass-card p-8 rounded-2xl group relative overflow-hidden" data-aos="fade-up"
                        data-aos-delay="{{ $index * 100 }}">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-gold-400/10 blur-[50px] rounded-full pointer-events-none group-hover:bg-gold-400/20 transition duration-500">
                        </div>

                        <div
                            class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mb-8 border border-white/10 group-hover:border-gold-400/50 group-hover:scale-110 transition duration-300">
                            <i class="{{ $service->icon ?? 'fas fa-gem' }} text-3xl text-gold-400"></i>
                        </div>
                        <h3 class="text-2xl font-serif text-white mb-4">{{ $service->name }}</h3>
                        <p
                            class="text-gray-400 text-sm leading-relaxed mb-6 font-light group-hover:text-gray-200 transition">
                            {{ Str::limit($service->description, 120) }}
                        </p>
                        <a href="#contact"
                            class="inline-flex items-center text-gold-400 text-sm font-semibold tracking-wide group-hover:translate-x-2 transition-transform">
                            Pesan Sekarang <i class="fas fa-long-arrow-alt-right ml-2"></i>
                        </a>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 glass-card rounded-2xl">
                        <p class="text-gray-500">Belum ada layanan yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="about" class="py-24 bg-dark-900 relative">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <div class="relative rounded-lg overflow-hidden border border-white/10">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80"
                            alt="About" class="w-full grayscale hover:grayscale-0 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-8 left-8">
                            <p class="text-gold-400 font-serif text-lg italic">"Perfection in every detail."</p>
                            <p class="text-white text-sm font-bold mt-1">CEO, LuxCorp</p>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-left">
                    <h2 class="font-serif text-4xl text-white mb-6">Tentang <span
                            class="text-gold-gradient">Perusahaan</span></h2>
                    <div class="text-gray-400 leading-relaxed mb-8 font-light space-y-4 text-justify">
                        {!! nl2br(e(Str::limit($company->description ?? 'Deskripsi perusahaan...', 400))) !!}
                    </div>

                    <div class="grid grid-cols-3 gap-6 border-t border-white/10 pt-8">
                        <div>
                            <h4 class="text-3xl font-serif text-white font-bold">10+</h4>
                            <p class="text-xs text-gold-400 uppercase tracking-widest mt-1">Tahun</p>
                        </div>
                        <div>
                            <h4 class="text-3xl font-serif text-white font-bold">500+</h4>
                            <p class="text-xs text-gold-400 uppercase tracking-widest mt-1">Proyek</p>
                        </div>
                        <div>
                            <h4 class="text-3xl font-serif text-white font-bold">98%</h4>
                            <p class="text-xs text-gold-400 uppercase tracking-widest mt-1">Puas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20" data-aos="fade-up">
                <h2 class="font-serif text-4xl md:text-5xl text-white mb-4">Masterpiece <span
                        class="text-gold-400">Terbaru</span></h2>
                <p class="text-gray-400 font-light max-w-2xl mx-auto">Setiap proyek adalah bukti komitmen kami terhadap
                    kualitas dan estetika.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $index => $project)
                    <div class="group relative rounded-xl overflow-hidden cursor-pointer" data-aos="fade-up"
                        data-aos-delay="{{ $index * 150 }}">
                        <div class="aspect-w-4 aspect-h-3">
                            <img src="{{ $project->image ? asset('storage/' . $project->image) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}"
                                alt="{{ $project->name }}"
                                class="w-full h-80 object-cover transition duration-700 transform group-hover:scale-110">
                        </div>
                        <div
                            class="absolute inset-0 bg-dark-950/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-6 text-center backdrop-blur-sm">
                            <span
                                class="text-gold-400 text-xs font-bold tracking-widest uppercase mb-3 transform translate-y-4 group-hover:translate-y-0 transition duration-500 delay-75">
                                {{ $project->category->name ?? 'Project' }}
                            </span>
                            <h3
                                class="text-2xl font-serif text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition duration-500 delay-100">
                                {{ $project->name }}
                            </h3>
                            <p
                                class="text-gray-300 text-sm font-light line-clamp-2 mb-6 transform translate-y-4 group-hover:translate-y-0 transition duration-500 delay-150">
                                {{ $project->description }}
                            </p>
                            <button
                                class="px-6 py-2 border border-gold-400 text-gold-400 rounded-full text-xs font-bold hover:bg-gold-400 hover:text-black transition transform translate-y-4 group-hover:translate-y-0 duration-500 delay-200">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500 py-10">Belum ada project yang ditambahkan.</div>
                @endforelse
            </div>

            <div class="text-center mt-16">
                <a href="#"
                    class="inline-block border-b border-gray-600 text-gray-400 pb-1 hover:text-white hover:border-white transition">Lihat
                    Seluruh Portfolio</a>
            </div>
        </div>
    </section>

    <section class="py-32 relative overflow-hidden">
        <div class="absolute -right-20 top-1/3 w-96 h-96 bg-gold-500/5 rounded-full blur-[80px]"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <i class="fas fa-quote-left text-5xl text-gold-400/20 mb-6"></i>
                <h2 class="font-serif text-4xl text-white">Suara <span class="text-gold-gradient">Klien</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($testimonials as $testi)
                    <div class="glass-card p-10 rounded-2xl relative" data-aos="fade-up">
                        <div class="flex items-center space-x-1 text-gold-400 text-xs mb-6">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="text-lg text-gray-300 italic font-light leading-relaxed mb-8">
                            "{{ Str::limit($testi->content, 200) }}"
                        </p>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-gray-700 flex items-center justify-center text-xl font-serif text-gold-400 mr-4 border border-gold-400/30">
                                {{ substr($testi->client_name ?? 'C', 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-white font-bold font-sans">{{ $testi->client_name ?? 'Happy Client' }}
                                </h4>
                                <p class="text-gray-500 text-xs uppercase tracking-wide">
                                    {{ $testi->position ?? 'Customer' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center text-gray-500">Belum ada testimoni.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="contact" class="py-32 relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-8 p-4 bg-green-900/20 border border-green-500/50 text-green-400 rounded-lg text-center backdrop-blur-sm"
                    data-aos="fade-down">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="glass-card rounded-3xl overflow-hidden shadow-2xl border border-gold-400/20"
                data-aos="zoom-in">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="p-12 lg:p-16 relative bg-dark-800/50">
                        <h2 class="font-serif text-4xl text-white mb-6">Siap Memulai?</h2>
                        <p class="text-gray-400 mb-10 font-light leading-relaxed">
                            Jangan biarkan ide besar Anda hanya menjadi wacana. Hubungi kami hari ini untuk konsultasi
                            gratis dan penawaran eksklusif.
                        </p>

                        <div class="space-y-8">
                            <div class="flex items-center space-x-5 group">
                                <div
                                    class="w-12 h-12 rounded-full bg-gold-400/10 flex items-center justify-center text-gold-400 border border-gold-400/20 group-hover:bg-gold-400 group-hover:text-black transition duration-300">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-widest">Email Kami</p>
                                    <p class="text-white font-medium">{{ $settings['email'] ?? 'hello@luxcorp.com' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-5 group">
                                <div
                                    class="w-12 h-12 rounded-full bg-gold-400/10 flex items-center justify-center text-gold-400 border border-gold-400/20 group-hover:bg-gold-400 group-hover:text-black transition duration-300">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-widest">Telepon / WA</p>
                                    <p class="text-white font-medium">{{ $settings['phone'] ?? '+62 812 3456 7890' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-5 group">
                                <div
                                    class="w-12 h-12 rounded-full bg-gold-400/10 flex items-center justify-center text-gold-400 border border-gold-400/20 group-hover:bg-gold-400 group-hover:text-black transition duration-300">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-widest">Lokasi</p>
                                    <p class="text-white font-medium">
                                        {{ Str::limit($settings['address'] ?? 'Jakarta, Indonesia', 30) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-12 lg:p-16 bg-white/[0.02]">
                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label
                                    class="text-xs text-gold-400 uppercase font-bold tracking-wider ml-1">Nama</label>
                                <input type="text" name="name" required
                                    class="w-full mt-2 bg-dark-950 border border-white/10 rounded-lg px-4 py-4 text-white focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition"
                                    placeholder="Nama Lengkap">
                            </div>
                            <div>
                                <label
                                    class="text-xs text-gold-400 uppercase font-bold tracking-wider ml-1">Email</label>
                                <input type="email" name="email" required
                                    class="w-full mt-2 bg-dark-950 border border-white/10 rounded-lg px-4 py-4 text-white focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition"
                                    placeholder="alamat@email.com">
                            </div>
                            <div>
                                <label
                                    class="text-xs text-gold-400 uppercase font-bold tracking-wider ml-1">Pesan</label>
                                <textarea name="message" rows="3" required
                                    class="w-full mt-2 bg-dark-950 border border-white/10 rounded-lg px-4 py-4 text-white focus:outline-none focus:border-gold-400 focus:ring-1 focus:ring-gold-400 transition"
                                    placeholder="Jelaskan proyek Anda..."></textarea>
                            </div>
                            <button type="submit"
                                class="w-full btn-gold py-4 font-bold tracking-widest uppercase text-sm rounded-lg shadow-xl hover:shadow-gold-400/30 transition duration-300">
                                Kirim Permintaan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black py-12 border-t border-white/10 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0 text-center md:text-left">
                <span class="font-serif text-2xl font-bold text-white">LUX<span
                        class="text-gold-400">CORP</span></span>
                <p class="text-gray-600 text-xs mt-2 font-light tracking-wide">&copy; {{ date('Y') }} All Rights
                    Reserved.</p>
            </div>

            <div class="flex space-x-8">
                <a href="#"
                    class="text-gray-500 hover:text-gold-400 transition transform hover:-translate-y-1"><i
                        class="fab fa-linkedin text-xl"></i></a>
                <a href="#"
                    class="text-gray-500 hover:text-gold-400 transition transform hover:-translate-y-1"><i
                        class="fab fa-instagram text-xl"></i></a>
                <a href="#"
                    class="text-gray-500 hover:text-gold-400 transition transform hover:-translate-y-1"><i
                        class="fab fa-twitter text-xl"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize Animate On Scroll
        AOS.init({
            once: true,
            duration: 800,
            offset: 100,
            easing: 'ease-out-cubic',
        });

        // Mobile Menu Toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Smooth scroll fix for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                menu.classList.add('hidden'); // Close mobile menu on click
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
