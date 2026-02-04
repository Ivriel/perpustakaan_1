<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Form Peminjaman Buku
            </h2>

            <a href="{{ url()->previous() }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">

                {{-- Informasi singkat buku yang akan dipinjam --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                        {{ $book->judul }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Penulis: {{ $book->penulis }} <br>
                        Penerbit: {{ $book->penerbit }} <br>
                        Tahun terbit: {{ $book->tahun_terbit }}
                    </p>
                </div>

                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Hidden book_id supaya controller tahu buku mana yang dipinjam --}}
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <div>
                        <label for="tanggal_pengembalian"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Tanggal Pengembalian
                        </label>
                        <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" required
                            min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                        {{-- Tampilkan error validasi kalau ada --}}
                        @error('tanggal_pengembalian')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        @error('book_id')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ url()->previous() }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm
                                  font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50
                                  dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                            Batal
                        </a>

                        <button type="submit" class="inline-flex justify-center items-center px-6 py-2 border border-transparent
                                       text-sm font-bold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700
                                       focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Konfirmasi Pinjam
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>