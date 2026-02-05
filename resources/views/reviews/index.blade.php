<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Reviews') }}
            </h2>

            <a href="{{ route('books.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; Kembali ke Daftar Buku
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left border-collapse">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-4 border-b dark:border-gray-700">No</th>
                                    <th class="px-6 py-4 border-b dark:border-gray-700">Pemberi Ulasan</th>
                                    <th class="px-6 py-4 border-b dark:border-gray-700">Buku</th>
                                    <th class="px-6 py-4 border-b dark:border-gray-700">Isi Ulasan</th>
                                    <th class="px-6 py-4 border-b dark:border-gray-700 text-center">Rating</th>
                                    <th class="px-6 py-4 border-b dark:border-gray-700">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($listReview as $review)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                                        <td class="px-6 py-4 font-medium">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-indigo-600 dark:text-indigo-400">
                                                {{ $review->user->nama_lengkap }}
                                            </div>
                                            <div class="text-xs text-gray-500 italic">@ {{ $review->user->username }}</div>
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-gray-700 dark:text-gray-300">
                                            {{ $review->book->judul }}
                                        </td>
                                        <td class="px-6 py-4 max-w-xs">
                                            <p class="truncate text-gray-600 dark:text-gray-400"
                                                title="{{ $review->ulasan }}">
                                                {{ $review->ulasan }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center space-x-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-xs whitespace-nowrap">
                                            {{ $review->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                                            Belum ada ulasan yang masuk.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>