<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ $appSettings['site_name'] ?? 'Dashboard' }}</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Tahoma, Verdana, Arial, sans-serif;
            background-color: #e5eef5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Gaya Border Klasik (Sesuai Dashboard) */
        .win-border {
            border: 2px solid #1e3a8a;
            box-shadow: inset 1px 1px #ffffff, inset -1px -1px #6b7280;
        }

        .win-header {
            background: linear-gradient(to right, #0f766e, #0891b2);
            color: white;
            padding: 8px 12px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Gaya Input Klasik */
        .win-input {
            border: 2px solid #9ca3af;
            border-top-color: #374151;
            border-left-color: #374151;
            border-bottom-color: #e5e7eb;
            border-right-color: #e5e7eb;
            background-color: white;
            width: 100%;
            padding: 6px 8px;
            font-size: 13px;
            outline: none;
        }

        .win-input:focus {
            background-color: #fffbeb;
            /* Sedikit kuning saat fokus */
        }

        /* Gaya Tombol Klasik */
        .win-btn {
            background-color: #e5e5e5;
            border: 2px solid #fff;
            border-right-color: #4b5563;
            border-bottom-color: #4b5563;
            padding: 5px 20px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            active: scale(0.98);
        }

        .win-btn:active {
            border: 2px solid #4b5563;
            border-right-color: #fff;
            border-bottom-color: #fff;
        }

        .win-btn-primary {
            background-color: #e5e5e5;
            /* Tetap abu-abu agar klasik */
            color: black;
        }
    </style>
</head>

<body>

    <div class="w-full max-w-md p-4">

        {{-- Container Utama --}}
        <div class="win-border bg-gray-100">

            {{-- Header Login --}}
            <div class="win-header">
                <span>🔐 Login System</span>
                <span class="text-xs opacity-80">v1.0</span>
            </div>

            {{-- Body Form --}}
            <div class="p-6">

                <div class="text-center mb-6">
                    <h2 class="text-xl font-bold text-blue-900">{{ $appSettings['site_name'] ?? 'PT Maju Bersama Teknologi' }}</h2>
                    <p class="text-xs text-gray-600">Silakan masuk untuk melanjutkan</p>
                </div>

                {{-- Menampilkan Error Validasi --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 text-xs mb-4">
                        <ul class="list-disc pl-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-xs font-bold text-gray-700 mb-1">Email Address:</label>
                        <input type="email" name="email" id="email" class="win-input"
                            value="{{ old('email') }}" required autofocus>
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <label for="password" class="block text-xs font-bold text-gray-700 mb-1">Password:</label>
                        <input type="password" name="password" id="password" class="win-input" required>
                    </div>

                    {{-- Remember Me & Submit --}}
                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-300">
                        <label class="flex items-center text-xs text-gray-700">
                            <input type="checkbox" name="remember" class="mr-2">
                            Ingat Saya
                        </label>

                        <button type="submit" class="win-btn win-btn-primary">
                            Login Masuk ➤
                        </button>
                    </div>

                </form>
            </div>

            {{-- Footer Kecil --}}
            <div class="bg-gray-200 px-4 py-2 text-xs text-gray-500 border-t border-white text-center">
                &copy; {{ date('Y') }} {{ $appSettings['site_name'] ?? 'PT Maju Bersama Teknologi' }} - Internal System
            </div>

        </div>
    </div>

</body>

</html>
