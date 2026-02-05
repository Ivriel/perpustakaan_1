<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Collections') }}
            </h2>
            <a href="{{ route('bookList.index') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition shadow-lg shadow-blue-200 dark:shadow-none flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Koleksi
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-gray-50/80 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase text-[11px] tracking-widest font-bold">
                                <th class="px-6 py-5 text-center">ID</th>
                                <th class="px-6 py-5">Info Buku</th>
                                <th class="px-6 py-5">Peminjam</th>
                                <th class="px-6 py-5 text-center">Tahun</th>
                                <th class="px-6 py-5">Ditambahkan</th>
                                <th class="px-8 py-5 text-center text-blue-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($data as $collection)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/20 transition-colors group">
                                    <td class="px-6 py-5 text-center">
                                        <span
                                            class="text-xs font-mono font-bold text-gray-400">#{{ $collection->id }}</span>
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ asset('storage/' . $collection->book->image) }}"
                                                class="w-10 h-14 object-cover rounded shadow-sm">
                                            <div>
                                                <div class="font-bold text-gray-900 dark:text-white text-sm line-clamp-1">
                                                    {{ $collection->book->judul }}
                                                </div>
                                                <div class="text-[11px] text-gray-500">{{ $collection->book->penulis }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center">
                                                <span class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400">
                                                    {{ strtoupper(substr($collection->user->nama_lengkap, 0, 1)) }}
                                                </span>
                                            </div>
                                            <span
                                                class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $collection->user->nama_lengkap }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 text-center">
                                        <span
                                            class="px-2.5 py-1 rounded-md text-[11px] font-bold bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                            {{ $collection->book->tahun_terbit }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="text-[11px] font-medium text-gray-500 dark:text-gray-400">
                                            {{ $collection->created_at->translatedFormat('d M Y') }}
                                            <span
                                                class="block text-[9px] opacity-70">{{ $collection->created_at->format('H:i') }}
                                                WIB</span>
                                        </div>
                                    </td>

                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('collections.show', $collection->id) }}"
                                                class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            @if ($collection->user_id == auth()->user()->id)
                                                <form action="{{ route('collections.destroy', $collection->id) }}" method="POST"
                                                    onsubmit="return confirm('Hapus koleksi ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center text-gray-400 italic">Belum ada koleksi
                                        tersimpan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>