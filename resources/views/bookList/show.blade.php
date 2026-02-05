<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url()->previous() }}"
                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detail Informasi Buku {{ $book->judul }}
            </h2>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="text-green-500 text-center">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="text-red-500 text-center">{{ session('error') }}</div>
    @endif

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="md:flex">
                    <div class="md:w-1/3 bg-gray-100 dark:bg-gray-900 p-8 flex justify-center items-start">
                        <div class="sticky top-8 w-full">
                            @if ($book->image)
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

                        <div class="space-y-3 mb-4">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Kategori</h4>
                            <div class="flex flex-wrap gap-2">
                                @forelse($book->categories as $category)
                                    <span
                                        class="px-4 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-xs font-bold border border-indigo-100 dark:border-indigo-800">
                                        {{ $category->name }}
                                    </span>
                                @empty
                                    <span class="text-sm text-gray-500 italic">Tidak ada kategori</span>
                                @endforelse
                            </div>
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
                                    Jumlah Kolektor
                                </p>
                                <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $book->collectors_count ?? 0 }} orang
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
                            <a href="{{ route('transactions.create', $book->id) }}"
                                class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-bold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Pinjam Buku Sekarang
                            </a>

                            {{-- POST book_id ke collections.store untuk add to collection --}}
                            <form action="{{ route('collections.store') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit"
                                    class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-emerald-600 text-base font-medium rounded-lg text-emerald-600 bg-white hover:bg-emerald-50 dark:bg-emerald-900/20 dark:text-emerald-400 dark:hover:bg-emerald-900/30">
                                    Tambah ke Koleksi
                                </button>
                            </form>

                            <a href="{{ route('bookList.index') }}"
                                class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                                Kembali ke Katalog
                            </a>
                        </div>

                        {{-- Section Ulasan/Review --}}
                        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">
                            <div class="mb-6">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Ulasan</h2>

                                {{-- Ringkasan Rating --}}
                                @if($book->review->count() > 0)
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= floor($averageRating))
                                                    <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                @elseif($i - 0.5 <= $averageRating)
                                                    <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <defs>
                                                            <linearGradient id="half-{{ $i }}">
                                                                <stop offset="50%" stop-color="currentColor" />
                                                                <stop offset="50%" stop-color="transparent" stop-opacity="1" />
                                                            </linearGradient>
                                                        </defs>
                                                        <path fill="url(#half-{{ $i }})"
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                @else
                                                    <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                                            {{ $averageRating }} dari 5.0
                                        </span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            ({{ $book->review->count() }}
                                            {{ $book->review->count() == 1 ? 'ulasan' : 'ulasan' }})
                                        </span>
                                    </div>
                                @else
                                    <p class="text-gray-500 dark:text-gray-400 mb-4">Belum ada ulasan untuk buku ini.</p>
                                @endif
                            </div>

                            {{-- Form Tulis/Edit Ulasan --}}
                            @auth
                                @if($userReview)
                                    {{-- Jika user sudah pernah review, tampilkan form edit --}}
                                    <div
                                        class="mb-8 p-6 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg border border-indigo-200 dark:border-indigo-800">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ulasan Anda</h3>
                                        <form action="{{ route('reviews.update', $userReview->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Rating
                                                </label>
                                                <select name="rating" required
                                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">
                                                    <option value="1" {{ $userReview->rating == 1 ? 'selected' : '' }}>1 - Sangat
                                                        Buruk</option>
                                                    <option value="2" {{ $userReview->rating == 2 ? 'selected' : '' }}>2 - Buruk
                                                    </option>
                                                    <option value="3" {{ $userReview->rating == 3 ? 'selected' : '' }}>3 - Biasa
                                                    </option>
                                                    <option value="4" {{ $userReview->rating == 4 ? 'selected' : '' }}>4 - Baik
                                                    </option>
                                                    <option value="5" {{ $userReview->rating == 5 ? 'selected' : '' }}>5 - Sangat
                                                        Baik</option>
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Ulasan
                                                </label>
                                                <textarea name="ulasan" rows="4" required
                                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">{{ $userReview->ulasan }}</textarea>
                                            </div>

                                            <div class="flex gap-3 flex-wrap">
                                                <button type="submit"
                                                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                                                    Perbarui Ulasan
                                                </button>
                                            </div>
                                        </form>

                                        {{-- Form hapus dipisah agar tidak nested --}}
                                        <form action="{{ route('reviews.destroy', $userReview->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Hapus ulasan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                                                Hapus Ulasan
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    {{-- Jika user belum pernah review, tampilkan form create --}}
                                    <div
                                        class="mb-8 p-6 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-200 dark:border-gray-700">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Tulis Ulasan</h3>
                                        <form action="{{ route('reviews.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Rating
                                                </label>
                                                <select name="rating" required
                                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">
                                                    <option value="">Pilih Rating</option>
                                                    <option value="1">1 - Sangat Buruk</option>
                                                    <option value="2">2 - Buruk</option>
                                                    <option value="3">3 - Biasa</option>
                                                    <option value="4">4 - Baik</option>
                                                    <option value="5">5 - Sangat Baik</option>
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Ulasan
                                                </label>
                                                <textarea name="ulasan" rows="4" required
                                                    placeholder="Tulis ulasan Anda tentang buku ini..."
                                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"></textarea>
                                            </div>

                                            <button type="submit"
                                                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                                                Kirim Ulasan
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @else
                                {{-- Jika user belum login, tampilkan pesan --}}
                                <div
                                    class="mb-8 p-6 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                                    <p class="text-gray-700 dark:text-gray-300">
                                        <a href="{{ route('login') }}"
                                            class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium">Login</a>
                                        untuk menulis ulasan.
                                    </p>
                                </div>
                            @endauth

                            {{-- Daftar Ulasan dari Semua User --}}
                            @if($book->review->count() > 0)
                                <div class="space-y-6">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Semua Ulasan</h3>
                                    @foreach($book->review as $review)
                                        <div
                                            class="p-6 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-200 dark:border-gray-700">
                                            <div class="flex items-start justify-between mb-3">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">
                                                        {{ strtoupper(substr($review->user->nama_lengkap ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-gray-900 dark:text-white">
                                                            {{ $review->user->nama_lengkap ?? 'User' }}
                                                        </p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $review->created_at->translatedFormat('d F Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                </path>
                                                            </svg>
                                                        @else
                                                            <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                </path>
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                                {{ $review->ulasan }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>