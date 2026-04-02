<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Dashboard Aspirasi Siswa 💎
        </h2>
    </x-slot>

    <!-- ✅ BACKGROUND GAMBAR (DIPERBAIKI Z-INDEX) -->
    <div class="fixed inset-0 z-0">
        <img src="https://i.pinimg.com/736x/e2/82/11/e28211b3375ead9a077e45ce270eb941.jpg"
             class="w-full h-full object-cover">
    </div>

    <!-- ✅ OVERLAY -->
    <div class="fixed inset-0 z-0 bg-gradient-to-br from-blue-100/70 via-sky-200/60 to-blue-300/70"></div>

    <style>
        .glass {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .card-hover:hover {
            transform: translateY(-5px) scale(1.01);
            transition: 0.3s;
        }

        .table-hover tr:hover {
            background: rgba(59,130,246,0.1);
        }
    </style>

    <!-- ✅ TAMBAH z-10 BIAR DI ATAS BACKGROUND -->
    <div class="py-10 text-gray-800 relative z-10">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- NOTIF -->
            @if (session('success'))
                <div class="glass p-4 rounded-lg text-green-700 border border-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <!-- STATISTIK -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="glass p-6 rounded-xl card-hover">
                    <h3 class="text-gray-600">Total Aspirasi</h3>
                    <p class="text-3xl font-bold">{{ $aspirasis->count() }}</p>
                </div>

                <div class="glass p-6 rounded-xl card-hover">
                    <h3 class="text-yellow-600">Pending</h3>
                    <p class="text-3xl font-bold">
                        {{ $aspirasis->where('status','pending')->count() }}
                    </p>
                </div>

                <div class="glass p-6 rounded-xl card-hover">
                    <h3 class="text-green-600">Selesai</h3>
                    <p class="text-3xl font-bold">
                        {{ $aspirasis->where('status','done')->count() }}
                    </p>
                </div>

            </div>

            <!-- FORM -->
            <div class="glass p-6 rounded-xl">
                <h2 class="mb-4 text-lg font-semibold">Kirim Aspirasi</h2>

                <form method="POST" action="{{ route('aspirasi.store') }}">
                    @csrf

                    <select name="category_id" class="w-full mb-3 p-2 rounded border border-gray-200">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>

                    <input type="text" name="location"
                           class="w-full mb-3 p-2 rounded border border-gray-200"
                           placeholder="Lokasi" required>

                    <textarea name="description"
                              class="w-full mb-3 p-2 rounded border border-gray-200"
                              placeholder="Deskripsi" required></textarea>

                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                        Kirim 🚀
                    </button>
                </form>
            </div>

            <!-- TABEL -->
            <div class="glass p-6 rounded-xl">
                <h2 class="mb-4 text-lg font-semibold">Riwayat</h2>

                <table class="w-full text-sm table-hover">
                    <thead class="border-b">
                        <tr>
                            <th class="py-2">Tanggal</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($aspirasis as $row)
                            <tr class="transition">
                                <td class="py-2">{{ $row->created_at->format('d/m/Y') }}</td>
                                <td>{{ $row->category->category_name }}</td>
                                <td>{{ $row->location }}</td>
                                <td>
                                    <span class="px-2 py-1 rounded text-xs
                                        {{ $row->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                        {{ $row->status == 'processing' ? 'bg-blue-200 text-blue-800' : '' }}
                                        {{ $row->status == 'done' ? 'bg-green-200 text-green-800' : '' }}">
                                        {{ strtoupper($row->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    Belum ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>