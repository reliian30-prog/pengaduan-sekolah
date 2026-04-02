<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'SMK PGRI') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: radial-gradient(circle at top, #1a0b3b, #0a0a23, #02010a);
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .btn-glow {
            box-shadow: 0 0 10px rgba(99,102,241,0.7), 0 0 20px rgba(139,92,246,0.6);
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(99,102,241,1), 0 0 40px rgba(139,92,246,1);
        }
    </style>
</head>

<body class="text-white min-h-screen flex justify-center items-center relative">

    <!-- NAVBAR -->
    <div class="absolute top-5 right-5 flex gap-3">
        @auth
            <a href="{{ url('/dashboard') }}"
               class="px-5 py-1.5 border rounded-sm text-sm hover:bg-white/10 transition">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}"
               class="px-5 py-1.5 border rounded-sm text-sm hover:bg-white/10 transition">
                Log in
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-5 py-1.5 border rounded-sm text-sm hover:bg-white/10 transition">
                    Register
                </a>
            @endif
        @endauth
    </div>

    <!-- BACKGROUND UTAMA -->
    <div class="fixed inset-0 -z-10">
        <img src="{{ asset('build/assets/galaxy-coding.jpeg') }}"
             class="w-full h-full object-cover opacity-30">
    </div>

    <!-- BACKGROUND TAMBAHAN -->
    <div class="fixed inset-0 -z-10">
        <img src="https://dashboard.thefinanser.com/wp-content/uploads/2025/05/Coders.png"
             class="w-full h-full object-cover opacity-20 blur-sm scale-110">
    </div>

    <!-- CONTENT -->
    <div class="glass rounded-2xl shadow-xl p-10 max-w-xl w-full text-center relative z-10">

        <h2 class="text-3xl font-bold mb-4 text-purple-300">
            Selamat Datang di Sistem Aspirasi Siswa 🚀
        </h2>

        <p class="text-gray-300 mb-6">
            Aplikasi ini digunakan untuk menampung dan menyampaikan saran, keluhan, serta pendapat siswa kepada pihak sekolah secara digital.
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}"
               class="px-6 py-2 bg-indigo-500 rounded-lg btn-glow text-white transition">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="px-6 py-2 bg-purple-600 rounded-lg btn-glow text-white transition">
                Register
            </a>
        </div>

    </div>

</body>
</html>