<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Transaksi') }} <span class="text-indigo-500 ml-2">#{{ $data->id }}</span>
            </h2>

            <div class="flex gap-3">
                <a href="{{ route('transaction.print', $data->id) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 dark:bg-purple-900/30 dark:text-purple-400 dark:hover:bg-purple-900/50 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    Print Receipt
                </a>

                <a href="{{ route('transactions.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-900/30 dark:text-indigo-400 dark:hover:bg-indigo-900/50 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-400 p-4 rounded-r-lg shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl overflow-hidden">
                <div
                    class="px-8 py-4 bg-gray-50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Status Peminjaman</span>
                    @php
                        $statusClasses = [
                            'dipinjam' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                            'kembali' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                            'terlambat' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400'
                        ];
                        $statusLabel = $data->status === 'kembali' ? 'Sudah Dikembalikan' : ($data->status === 'dipinjam' ? 'Sedang Dipinjam' : 'Terlambat');
                    @endphp
                    <span
                        class="px-4 py-1.5 rounded-full text-xs font-bold {{ $statusClasses[$data->status] ?? $statusClasses['terlambat'] }}">
                        {{ strtoupper($statusLabel) }}
                    </span>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                        <div class="lg:col-span-1">
                            <div class="relative group">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl blur opacity-25 group-hover:opacity-40 transition duration-1000">
                                </div>
                                <div class="relative bg-white dark:bg-gray-900 p-2 rounded-xl shadow-sm">
                                    @if($data->book && $data->book->image)
                                        <img src="{{ asset('storage/' . $data->book->image) }}" alt="Cover Buku"
                                            class="w-full h-auto rounded-lg object-cover shadow-inner">
                                    @else
                                        <div
                                            class="aspect-[3/4] flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-lg">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-2 space-y-8">

                            <section>
                                <h3
                                    class="flex items-center text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                    Informasi Koleksi
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-4">
                                    <div>
                                        <label class="text-xs text-gray-500 dark:text-gray-400 block uppercase">Judul
                                            Buku</label>
                                        <p class="text-lg font-bold text-gray-900 dark:text-white leading-tight">
                                            {{ $data->book->judul ?? '-' }}
                                        </p>
                                    </div>
                                    <div>
                                        <label
                                            class="text-xs text-gray-500 dark:text-gray-400 block uppercase">Penulis</label>
                                        <p class="font-semibold text-gray-700 dark:text-gray-300">
                                            {{ $data->book->penulis ?? '-' }}
                                        </p>
                                    </div>
                                    <div>
                                        <label
                                            class="text-xs text-gray-500 dark:text-gray-400 block uppercase">Penerbit</label>
                                        <p class="text-lg font-bold text-gray-900 dark:text-white leading-tight">
                                            {{ $data->book->penerbit ?? '-' }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500 dark:text-gray-400 block uppercase">Tahun
                                            Terbit</label>
                                        <p class="font-semibold text-gray-700 dark:text-gray-300">
                                            {{ $data->book->tahun_terbit ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 gap-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                                <section>
                                    <h3
                                        class="flex items-center text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">
                                        Peminjam</h3>
                                    <div class="space-y-3">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800 dark:text-gray-200">
                                                {{ $data->user->nama_lengkap ?? '-' }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $data->user->email ?? '-' }}</p>
                                            <p class="text-xs text-gray-500 font-bold">role:
                                                {{ $data->user->role ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <h3
                                        class="flex items-center text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">
                                        Timeline</h3>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Pinjam:</span>
                                            <span
                                                class="font-medium text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($data->tanggal_peminjaman)->translatedFormat('d M Y, H:i') }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Batas:</span>
                                            <span
                                                class="font-medium text-rose-500">{{ \Carbon\Carbon::parse($data->tanggal_pengembalian)->translatedFormat('d M Y') }}</span>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            @if ($data->status === 'dipinjam' && $data->user_id === auth()->id())
                                <div class="pt-6 border-t border-gray-100 dark:border-gray-700">
                                    <form action="{{ route('transactions.returnBook', $data->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin mengembalikan buku {{ $data->book->judul }}?');">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex justify-center items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 dark:shadow-none transition-all transform hover:-translate-y-1">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z"></path>
                                            </svg>
                                            Kembalikan Buku Sekarang
                                        </button>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>