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
            margin: 0;
            background: radial-gradient(circle at top, #1a0b3b, #0a0a23, #02010a);
            overflow: hidden;
        }

        /* ===== 3D BACKGROUND ===== */
        .scene, .a3d { display: grid }

        .scene {
            position: fixed;
            inset: 0;
            z-index: -10;
            perspective: 35em;
            overflow: hidden;
            mask: linear-gradient(90deg, #0000, red 20% 80%, #0000);
        }

        .a3d {
            place-self: center;
            transform-style: preserve-3d;
            animation: ry 40s linear infinite;
        }

        @keyframes ry { 
            to { transform: rotateY(360deg); } 
        }

        .card {
            --w: 220px;
            --ba: calc(360deg / var(--n));
            grid-area: 1/1;
            width: var(--w);
            aspect-ratio: 7/10;
            object-fit: cover;
            border-radius: 20px;
            backface-visibility: hidden;

            transform:
                rotateY(calc(var(--i) * var(--ba)))
                translateZ(calc(-1 * (0.5 * var(--w) / tan(180deg / var(--n)))));
        }

        /* ===== GLASS UI ===== */
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

    <!-- DATA IMAGE -->
    @php
        $images = [
            '1540968221243-29f5d70540bf',
            '1596135187959-562c650d98bc',
            '1628944682084-831f35256163',
            '1590013330451-3946e83e0392',
            '1590421959604-741d0eec0a2e',
            '1572613000712-eadc57acbecd',
            '1570097192570-4b49a6736f9f',
            '1620789550663-2b10e0080354',
            '1617775623669-20bff4ffaa5c',
            '1548600916-dc8492f8e845',
            '1573824969595-a76d4365a2e6',
            '1633936929709-59991b5fdd72'
        ];
    @endphp

    <!-- 3D BACKGROUND -->
    <div class="scene">
        <div class="a3d" style="--n: {{ count($images) }}">
            @foreach ($images as $i => $img)
                <img class="card"
                     src="https://images.unsplash.com/photo-{{ $img }}?w=400"
                     style="--i: {{ $i }}"
                     alt="bg">
            @endforeach
        </div>
    </div>

    <!-- NAVBAR -->
    <div class="absolute top-5 right-5 flex gap-3 z-10">
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