<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url()->previous() }}"
                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detail Informasi Buku {{ $book->judul }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="md:flex">
                    <div class="md:w-1/3 bg-gray-100 dark:bg-gray-900 p-8 flex justify-center items-start">
                        <div class="sticky top-8 w-full">
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}"
                                    class="w-full rounded-lg shadow-lg object-cover border-4 border-white dark:border-gray-700">
                            @else
                                <div
                                    class="w-full h-80 bg-gray-300 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-500">
                                    <span class="text-sm">Tidak ada sampul</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="md:w-2/3 p-8">
                        <div class="mb-6">
                            <span
                                class="px-3 py-1 text-xs font-semibold text-indigo-600 bg-indigo-100 rounded-full uppercase dark:bg-indigo-900 dark:text-indigo-300">
                                ID Buku: #{{ $book->id }}
                            </span>
                            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-3 leading-tight">
                                {{ $book->judul }}
                            </h1>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="space-y-1">
                                <p
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Penulis</p>
                                <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $book->penulis }}
                                </p>
                            </div>

                            <div class="space-y-1">
                                <p
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Penerbit</p>
                                <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $book->penerbit }}
                                </p>
                            </div>

                            <div class="space-y-1">
                                <p
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Tahun Terbit</p>
                                <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $book->tahun_terbit }}
                                </p>
                            </div>

                            <div class="space-y-1">
                                <p
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Ditambahkan Pada</p>
                                <p class="text-md text-gray-800 dark:text-gray-200">
                                    {{ $book->created_at ? $book->created_at->format('d M Y H:m:s') : '-' }} WIB
                                </p>
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200 dark:border-gray-700">

                        <div
                            class="bg-gray-50 dark:bg-gray-900/50 rounded-xl p-4 mb-8 border border-gray-100 dark:border-gray-700">
                            <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Metadata Sistem
                            </h4>
                            <div class="text-xs text-gray-500 dark:text-gray-400 space-y-1">
                                <p>Terakhir diperbarui:
                                    {{ $book->updated_at ? $book->updated_at->diffForHumans() : 'Belum pernah diperbarui' }}
                                </p>
                                <p>Tipe Data ID: BigInt (Unsigned)</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <button
                                class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-bold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Pinjam Buku Sekarang
                            </button>

                            <a href="{{ route('bookList.index') }}"
                                class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                                Kembali ke Katalog
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>