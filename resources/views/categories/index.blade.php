<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Category') }}
            </h2>
            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 transition ease-in-out duration-150">
                <i class="fas fa-plus mr-2"></i> Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-4 flex justify-end">
                        <div class="relative">
                            <form action="{{ route('categories.index') }}" method="GET" class="flex-grow flex gap-2">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari kategori..."
                                    class="w-full rounded-xl border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-6 py-2 rounded-xl">Cari</button>
                                @if (request('search'))
                                    <a class="bg-gray-700 text-white px-6 py-2 rounded-xl"
                                        href="{{ route('categories.index') }}">Reset</a>
                                @endif
                            </form>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-bold">ID</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Category Name</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Created At</th>
                                    <th scope="col" class="px-6 py-4 font-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($categories as $category)
                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-150">
                                        <td class="px-6 py-4 font-medium text-gray-500 dark:text-gray-400">
                                            #{{ $category->id }}
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-gray-600 dark:text-gray-400">
                                                <p class="text-sm font-medium">
                                                    {{ \Carbon\Carbon::parse($category->created_at)->format('d/m/Y') }}
                                                </p>
                                                <p class="text-xs opacity-75">
                                                    {{ \Carbon\Carbon::parse($category->created_at)->format('H:i:s') }} WIB
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center items-center space-x-3">
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="text-amber-500 hover:text-amber-700 transition"
                                                    title="Edit Data">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Hapus kategori {{ $category->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 transition"
                                                        title="Hapus Data">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                            Belum ada data kategori.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{--
                    @if($categories->hasPages())
                    <div class="mt-6">
                        {{ $categories->links() }}
                    </div>
                    @endif --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>