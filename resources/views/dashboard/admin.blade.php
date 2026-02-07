<div class="p-6 bg-gray-900 min-h-screen font-sans text-gray-200">

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 p-6 bg-gray-800/50 border border-gray-700 rounded-2xl shadow-sm">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">
                {{ $greeting }}, <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">{{ Auth::user()->nama_lengkap }}</span> 👋
            </h1>
            <p class="text-gray-400 mt-1 flex items-center gap-2">
                <span class="flex w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                Sistem berjalan optimal hari ini.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 flex items-center gap-3 shadow-sm shadow-indigo-500/10">
                <i class="fas fa-calendar text-indigo-400"></i>
                <span class="text-sm font-medium">{{ now()->format('d F Y') }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="group bg-gray-800 border border-gray-700 p-5 rounded-2xl transition-all hover:scale-[1.02] hover:border-indigo-500/50 shadow-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Total Members</p>
                    <h3 class="text-2xl font-bold text-white mt-1">{{ number_format($total_user) }}</h3>
                </div>
                <div class="p-3 bg-indigo-500/10 rounded-xl text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="group bg-gray-800 border border-gray-700 p-5 rounded-2xl transition-all hover:scale-[1.02] hover:border-emerald-500/50 shadow-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Koleksi Buku</p>
                    <h3 class="text-2xl font-bold text-white mt-1">{{ number_format($total_buku) }}</h3>
                </div>
                <div class="p-3 bg-emerald-500/10 rounded-xl text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"></path></svg>
                </div>
            </div>
        </div>

        <div class="group bg-gray-800 border border-gray-700 p-5 rounded-2xl transition-all hover:scale-[1.02] hover:border-blue-500/50 shadow-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Total Transaksi</p>
                    <h3 class="text-2xl font-bold text-white mt-1">{{ number_format($total_transaksi) }}</h3>
                </div>
                <div class="p-3 bg-blue-500/10 rounded-xl text-blue-400 group-hover:bg-blue-500 group-hover:text-white transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
            </div>
        </div>

        <div class="group bg-gray-800 border border-gray-700 p-5 rounded-2xl transition-all hover:scale-[1.02] hover:border-amber-500/50 shadow-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Avg. Rating</p>
                    <h3 class="text-2xl font-bold text-white mt-1">{{ number_format($rata_rata_rating, 1) }} ★</h3>
                </div>
                <div class="p-3 bg-amber-500/10 rounded-xl text-amber-400 group-hover:bg-amber-500 group-hover:text-white transition-all">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-gray-800 border border-gray-700 rounded-3xl overflow-hidden shadow-2xl">
                <div class="px-6 py-5 border-b border-gray-700 flex justify-between items-center bg-gray-800/50">
                    <h2 class="text-lg font-bold text-white">Transaksi Terbaru</h2>
                    <a href="#" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 uppercase tracking-widest transition">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-gray-500 text-xs uppercase tracking-widest border-b border-gray-700">
                                <th class="px-6 py-4 font-semibold">User & Buku</th>
                                <th class="px-6 py-4 font-semibold">Status</th>
                                <th class="px-6 py-4 font-semibold text-right">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700/50 text-sm">
                            @foreach($transaksi_terbaru as $trx)
                                <tr class="hover:bg-gray-700/30 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-500/20">
                                                {{ substr($trx->user->nama_lengkap ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-white font-medium group-hover:text-indigo-300 transition">{{ $trx->user->nama_lengkap ?? 'Guest' }}</p>
                                                <p class="text-gray-500 text-xs truncate max-w-[200px]">{{ $trx->book->judul ?? 'No Title' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColor = match ($trx->status) {
                                                'dipinjam' => 'text-blue-400 bg-blue-400/10 border-blue-400/20',
                                                'terlambat' => 'text-red-400 bg-red-400/10 border-red-400/20',
                                                default => 'text-green-400 bg-green-400/10 border-green-400/20',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium border {{ $statusColor }}">
                                            {{ ucfirst($trx->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-gray-500 font-mono text-xs italic group-hover:text-gray-300">
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
                <h2 class="text-lg font-bold text-white mb-6">Status Peminjaman</h2>
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-400 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span> Aktif Dipinjam
                            </span>
                            <span class="text-white font-bold">{{ $total_buku_dipinjam }}</span>
                        </div>
                        <div class="w-full bg-gray-900 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class=" flex items-center gap-2 text-red-400">
                                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span> Terlambat
                            </span>
                            <span class="text-red-400 font-bold">{{ $total_buku_terlambat_dikembalikan }}</span>
                        </div>
                        <div class="w-full bg-gray-900 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full shadow-[0_0_10px_rgba(239,68,68,0.4)]" style="width: 20%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-indigo-900/40 to-purple-900/40 border border-indigo-500/30 p-6 rounded-3xl shadow-xl relative overflow-hidden group">
                <div class="relative z-10">
                    <h2 class="text-white font-bold mb-4 flex items-center justify-between">
                        Kategori Populer
                        <i class="fas fa-fire text-amber-500"></i>
                    </h2>
                    <div class="flex flex-wrap gap-2 pt-2">
                        @foreach($kategori_populer as $kategori)
                            <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-xl text-xs text-indigo-200 hover:bg-indigo-500 hover:text-white transition duration-300">
                                #{{ $kategori->name }} <span class="text-indigo-400 ml-1">({{ $kategori->transaction_count }})</span>
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="absolute -bottom-10 -right-10 w-24 h-24 bg-indigo-500 rounded-full blur-[60px] opacity-20 group-hover:opacity-40 transition-opacity"></div>
            </div>
        </div>
    </div>
</div>