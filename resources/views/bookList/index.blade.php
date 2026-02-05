<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Koleksi Perpustakaan') }}
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan semua buku yang tersedia
            </div>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="text-green-500 text-center">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="text-red-500 text-center">{{ session('error') }}</div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($bookList as $book)
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 flex flex-col">

                        <div class="relative h-64 overflow-hidden bg-gray-200">
                            @if ($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-2 right-2">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                    {{ $book->tahun_terbit }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 flex-grow flex flex-col">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1 line-clamp-1">
                                {{ $book->judul }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                                <span class="font-medium">Penulis:</span> {{ $book->penulis }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mb-4 italic">
                                {{ $book->penerbit }}
                            </p>

                            <div class="mt-auto flex gap-2">
                                <a href="{{ route('bookList.show', $book->id) }}"
                                    class="flex-1 inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                                    Detail
                                </a>
                                <button type="button"
                                    class="flex-1 inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                    Pinjam
                                </button>
                                {{-- Form POST mengirim book_id ke route collections.store (isi table collection) --}}
                                <form action="{{ route('collections.store') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit"
                                        class="flex-1 inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                                        Tambah ke Koleksi
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white dark:bg-gray-800 rounded-lg">
                        <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada koleksi buku saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
