<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Buku') }}
            </h2>
            <a href="{{ route('books.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; Kembali ke Daftar Buku
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">

                <div class="flex flex-col md:flex-row gap-10">
                    <div class="w-full md:w-1/3 flex-shrink-0">
                        <div class="sticky top-6">
                            @if ($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}"
                                    class="w-full rounded-lg shadow-2xl border dark:border-gray-700"
                                    alt="{{ $book->judul }}">
                            @else
                                <div
                                    class="w-full aspect-[3/4] bg-gray-100 dark:bg-gray-700 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center">
                                    <span class="text-gray-400">Tidak ada cover</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="w-full md:w-2/3">
                        <div class="mb-6">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $book->judul }}</h1>
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($book->categories as $cat)
                                    <span
                                        class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 text-xs font-bold rounded-full uppercase tracking-wider">
                                        {{ $cat->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-y-6">
                            <div class="border-b border-gray-100 dark:border-gray-700 pb-4">
                                <p
                                    class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-widest font-semibold mb-1">
                                    Penulis</p>
                                <p class="text-lg text-gray-800 dark:text-gray-200">{{ $book->penulis }}</p>
                            </div>

                            <div class="border-b border-gray-100 dark:border-gray-700 pb-4">
                                <p
                                    class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-widest font-semibold mb-1">
                                    Penerbit</p>
                                <p class="text-lg text-gray-800 dark:text-gray-200">{{ $book->penerbit }}</p>
                            </div>

                            <div class="border-b border-gray-100 dark:border-gray-700 pb-4">
                                <p
                                    class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-widest font-semibold mb-1">
                                    Tahun Terbit</p>
                                <p class="text-lg text-gray-800 dark:text-gray-200">{{ $book->tahun_terbit }}</p>
                            </div>

                            <div class="pt-4 flex items-center gap-4">
                                <a href="{{ route('books.edit', $book->id) }}"
                                    class="flex-1 text-center px-6 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition shadow-lg">
                                    Edit Buku
                                </a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="flex-1"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku {{ $book->judul }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-full px-6 py-3 bg-white dark:bg-gray-700 text-red-600 border border-red-200 dark:border-red-900/30 font-bold rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                        Hapus Buku
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>