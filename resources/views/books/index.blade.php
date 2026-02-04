<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Buku') }}
            </h2>
            <a href="{{ route('books.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 transition ease-in-out duration-150 shadow-sm">
                <i class="fas fa-plus mr-2"></i> Tambah Buku
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-4">Cover</th>
                                <th scope="col" class="px-6 py-4">Judul</th>
                                <th scope="col" class="px-6 py-4">Kategori</th>
                                <th scope="col" class="px-6 py-4">Penulis</th>
                                <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($books as $book)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($book->image)
                                            <img src="{{ asset('storage/' . $book->image) }}"
                                                class="w-12 h-16 object-cover rounded-md shadow-sm border dark:border-gray-600"
                                                alt="{{ $book->judul }}">
                                        @else
                                            <div
                                                class="w-12 h-16 bg-gray-200 dark:bg-gray-700 rounded-md flex items-center justify-center">
                                                <i class="fas fa-book text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $book->judul }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @forelse($book->categories as $cat)
                                                <span
                                                    class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 rounded">
                                                    {{ $cat->name }}
                                                </span>
                                            @empty
                                                <span class="text-gray-400 italic text-xs">Tanpa Kategori</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $book->penulis }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('books.edit', $book->id) }}"
                                                class="text-amber-600 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300 font-semibold">
                                                Edit
                                            </a>
                                            <a href="{{ route('books.show', $book->id) }}"
                                                class="text-green-600 hover:text-green-600 dark:text-green-400 dark:hover:text-green-300 font-semibold">
                                                Detail
                                            </a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku {{ $book->judul }}?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 font-semibold">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-folder-open text-4xl mb-2 text-gray-300"></i>
                                            <p>Belum ada data buku yang tersimpan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>