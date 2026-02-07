<div class="p-6 bg-gray-900 min-h-screen font-sans text-gray-200">

    <div
        class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 p-6 bg-gray-800/50 border border-gray-700 rounded-2xl shadow-sm">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">
                {{ $greeting }}, <span
                    class="bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 to-cyan-400">{{ Auth::user()->nama_lengkap }}</span>
                👋
            </h1>
            <p class="text-gray-400 mt-1 flex items-center gap-2">
                <span class="flex w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                Petugas standby: Sistem sirkulasi berjalan optimal.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <div
                class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 flex items-center gap-3 shadow-sm shadow-emerald-500/5">
                <i class="fas fa-calendar-check text-emerald-400"></i>
                <span class="text-sm font-medium">{{ now()->format('d F Y') }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="group bg-gray-800 border border-gray-700 p-5 rounded-2xl transition-all hover:border-blue-500/50">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Aktif Dipinjam</p>
            <div class="flex items-end justify-between mt-1">
                <h3 class="text-3xl font-bold text-white">{{ number_format($total_buku_dipinjam) }}</h3>
                <span class="text-blue-400 text-sm font-medium">Buku</span>
            </div>
        </div>

        <div
            class="group bg-gray-800 border border-red-900/50 p-5 rounded-2xl transition-all hover:border-red-500/50 shadow-lg shadow-red-500/5">
            <p class="text-xs font-bold text-red-500/80 uppercase tracking-widest">Wajib Kembali</p>
            <div class="flex items-end justify-between mt-1">
                <h3 class="text-3xl font-bold text-red-500">{{ number_format($total_buku_terlambat_dikembalikan) }}</h3>
                <span class="text-red-400 text-sm font-medium animate-bounce">Segera Cek</span>
            </div>
        </div>

        <div
            class="group bg-gray-800 border border-gray-700 p-5 rounded-2xl transition-all hover:border-emerald-500/50">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Stok di Rak</p>
            <div class="flex items-end justify-between mt-1">
                <h3 class="text-3xl font-bold text-white">{{ number_format($total_buku - $total_buku_dipinjam) }}</h3>
                <span class="text-emerald-400 text-sm font-medium">Ready</span>
            </div>
        </div>

        <div class="group bg-gray-800 border border-gray-700 p-5 rounded-2xl transition-all hover:border-purple-500/50">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Total Members</p>
            <div class="flex items-end justify-between mt-1">
                <h3 class="text-3xl font-bold text-white">{{ number_format($total_user) }}</h3>
                <i class="fas fa-users text-purple-400 mb-1"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-gray-800 border border-gray-700 rounded-3xl overflow-hidden shadow-2xl">
                <div class="px-6 py-5 border-b border-gray-700 bg-gray-800/50">
                    <h2 class="text-lg font-bold text-white">Log Sirkulasi Terakhir</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead
                            class="text-gray-500 text-xs uppercase tracking-widest border-b border-gray-700 text-left">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Peminjam</th>
                                <th class="px-6 py-4 font-semibold">Buku</th>
                                <th class="px-6 py-4 text-center font-semibold">Status</th>
                                <th class="px-6 py-4 text-right font-semibold">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700/50">
                            @foreach($transaksi_terbaru as $trx)
                                <tr class="hover:bg-gray-700/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-white">{{ $trx->user->nama_lengkap }}</td>
                                    <td class="px-6 py-4 text-gray-400 truncate max-w-[180px]">{{ $trx->book->judul }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-2 py-1 rounded-md text-[10px] font-bold uppercase border {{ $trx->status == 'dipinjam' ? 'border-blue-500/50 text-blue-400' : 'border-green-500/50 text-green-400' }}">
                                            {{ $trx->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-gray-500 font-mono text-xs">
                                        {{ $trx->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-3xl shadow-xl">
                <h2 class="text-lg font-bold text-white mb-4">Quick Menu</h2>
                <div class="grid grid-cols-1 gap-3">
                    <a href="{{ route('bookList.index') }}"
                        class="flex items-center justify-between p-4 bg-gray-900/50 rounded-2xl border border-gray-700 hover:border-indigo-500 transition group">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-indigo-500/10 flex items-center justify-center text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-gray-300 group-hover:text-white">Kelola Buku</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-600 group-hover:text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>

                    <a href="{{ route('transactions.index') }}"
                        class="flex items-center justify-between p-4 bg-gray-900/50 rounded-2xl border border-gray-700 hover:border-emerald-500 transition group">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-gray-300 group-hover:text-white">Transaksi
                                Sirkulasi</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-600 group-hover:text-emerald-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-amber-900/20 to-orange-900/20 border border-amber-500/30 p-6 rounded-3xl shadow-xl">
                <div class="flex items-center gap-3 text-amber-500 mb-3">
                    <i class="fas fa-shield-alt"></i>
                    <h3 class="font-bold text-sm uppercase italic">Protokol</h3>
                </div>
                <p class="text-xs text-amber-200/60 leading-relaxed italic">
                    Periksa kondisi fisik buku sebelum mengubah status menjadi "Kembali".
                </p>
            </div>
        </div>
    </div>
</div>