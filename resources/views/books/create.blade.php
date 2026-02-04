<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Buat Buku') }}
            </h2>
            <a href="{{ route('books.index') }}"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="judul" :value="__('Judul Buku')" />
                            <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full"
                                :value="old('judul')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('judul')" />
                        </div>

                        <div>
                            <x-input-label for="image" :value="__('Cover Buku (Image)')" />
                            <input id="image" name="image" type="file"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div>
                            <x-input-label :value="__('Kategori')" />
                            <div
                                class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                @foreach ($categories as $category)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            @checked(in_array($category->id, old('categories', [])))>
                                        <span
                                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('categories')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="penulis" :value="__('Penulis')" />
                                <x-text-input id="penulis" name="penulis" type="text" class="mt-1 block w-full"
                                    :value="old('penulis')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('penulis')" />
                            </div>

                            <div>
                                <x-input-label for="penerbit" :value="__('Penerbit')" />
                                <x-text-input id="penerbit" name="penerbit" type="text" class="mt-1 block w-full"
                                    :value="old('penerbit')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('penerbit')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="tahun_terbit" :value="__('Tahun Terbit')" />
                            <x-text-input id="tahun_terbit" name="tahun_terbit" type="number" class="mt-1 block w-full"
                                :value="old('tahun_terbit')" placeholder="Contoh: 2024" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tahun_terbit')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Buku') }}</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
