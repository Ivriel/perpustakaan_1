<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detail Koleksi: {{ $data->book->judul }}
            </h2>
            <a href="{{ route('collections.index') }}"
                class="flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-indigo-600 transition group">
                <div class="p-1.5 rounded-lg bg-gray-100 group-hover:bg-indigo-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 shadow-2xl sm:rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-12">

                    <div
                        class="md:col-span-4 bg-gray-50/50 dark:bg-gray-900/20 p-8 flex flex-col items-center border-r border-gray-100 dark:border-gray-700">
                        <div class="sticky top-8 text-center">
                            <img src="{{ asset('storage/' . $data->book->image) }}"
                                class="w-56 rounded-2xl shadow-2xl mx-auto mb-6 transform hover:scale-105 transition duration-500">

                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Database
                                ID</span>
                            <p class="text-2xl font-mono font-bold text-indigo-600">#{{ $data->id }}</p>
                        </div>
                    </div>

                    <div class="md:col-span-8 p-8 md:p-12">
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-4xl font-black text-gray-900 dark:text-white leading-tight mb-2">
                                    {{ $data->book->judul }}
                                </h3>
                                <p class="text-xl text-indigo-500 font-medium tracking-tight">Karya
                                    {{ $data->book->penulis }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-8">
                                <div class="space-y-1">
                                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Penerbit
                                    </h4>
                                    <p class="text-gray-700 dark:text-gray-300 font-bold text-lg">
                                        {{ $data->book->penerbit }}
                                    </p>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Tahun
                                        Terbit</h4>
                                    <p class="text-gray-700 dark:text-gray-300 font-bold text-lg">
                                        {{ $data->book->tahun_terbit }}
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Kategori Buku
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($data->book->categories as $category)
                                        <span
                                            class="px-3 py-1 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-xs font-bold text-gray-600 dark:text-gray-300 shadow-sm">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <div
                                class="p-6 rounded-2xl bg-indigo-50/50 dark:bg-indigo-900/10 border border-indigo-100 dark:border-indigo-900/30">
                                <h4 class="text-[11px] font-bold text-indigo-400 uppercase tracking-widest mb-4">
                                    Informasi Kolektor</h4>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ strtoupper(substr($data->user->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-gray-900 dark:text-white font-bold">
                                            {{ $data->user->nama_lengkap }}
                                        </p>
                                        <p class="text-xs text-gray-500 italic">Menambahkan koleksi pada
                                            {{ $data->created_at->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
                                <p class="text-[10px] text-gray-400 italic">Terakhir diupdate
                                    {{ $data->updated_at->diffForHumans() }}
                                </p>

                                @if ($data->user_id == auth()->user()->id)
                                    <form action="{{ route('collections.destroy', $data->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus dari koleksi?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="text-sm font-bold text-red-500 hover:text-red-700 transition flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus Koleksi
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>