{{-- Menggunakan layout utama aplikasi (komponen Blade yang disediakan oleh Breeze/Jetstream) --}}
<x-app-layout>
    {{-- Slot "header" untuk judul halaman --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Transaksi Peminjaman') }}
            </h2>

            {{-- Tombol opsional: kembali ke daftar buku, kalau ingin navigasi cepat --}}
            <a href="{{ route('bookList.index') }}"
                class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; Kembali ke Daftar Buku
            </a>
        </div>
    </x-slot>

    {{-- Area konten utama --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card kontainer --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                {{-- Menampilkan pesan sukses jika ada di session (dari with('success', ...)) --}}
                @if (session('success'))
                    <div class="px-6 pt-6">
                        <div class="bg-green-100 border border-green-200 text-green-800 text-sm px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <div class="overflow-x-auto p-6">
                    {{-- Tabel daftar transaksi --}}
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Judul Buku</th>
                                <th class="px-4 py-3">Peminjam</th>
                                <th class="px-4 py-3">Tanggal Peminjaman</th>
                                <th class="px-4 py-3">Batas Pengembalian</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            {{-- Perulangan semua transaksi yang dikirim dari controller sebagai $transactions --}}
                            @forelse ($data as $transaction)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-3">
                                        {{-- $loop->iteration berisi nomor urut dalam perulangan --}}
                                        {{ $transaction->id }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                        {{-- Mengakses judul buku melalui relasi book pada model Transaction --}}
                                        {{ $transaction->book->judul ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{-- Mengakses nama user melalui relasi user pada model Transaction --}}
                                        {{ $transaction->user->nama_lengkap ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{-- Format tanggal peminjaman dengan method format() milik Carbon --}}
                                        {{ \Carbon\Carbon::parse($transaction->tanggal_peminjaman)->format('d-m-Y H:i:s') }}
                                        WIB
                                    </td>
                                    <td class="px-4 py-3">
                                        {{-- Format tanggal batas pengembalian --}}
                                        {{ \Carbon\Carbon::parse($transaction->tanggal_pengembalian)->format('d-m-Y') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{-- Menampilkan status dengan styling sederhana --}}
                                        @if ($transaction->status === 'dipinjam')
                                            <span class="px-2 py-1 text-xs font-semibold rounded bg-blue-100 text-blue-800">
                                                Dipinjam
                                            </span>
                                        @elseif ($transaction->status === 'kembali')
                                            <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">
                                                Kembali
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-800">
                                                Terlambat
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-3">
                                            {{-- Link untuk melihat detail transaksi (route transactions.show) --}}
                                            <a href="{{ route('transactions.show', $transaction->id) }}"
                                                class="text-indigo-600 hover:text-indigo-800 text-xs font-semibold">
                                                Detail
                                            </a>

                                            {{-- Form untuk mengembalikan buku:
                                            hanya tampil jika:
                                            - status masih "dipinjam"
                                            - dan transaksi ini milik user yang sedang login --}}
                                            @if ($transaction->status === 'dipinjam' && $transaction->user_id === auth()->id())
                                                <form action="{{ route('transactions.returnBook', $transaction->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin mengembalikan buku {{ $transaction->book->judul }}?');">
                                                    {{-- Token CSRF wajib di setiap form POST di Laravel --}}
                                                    @csrf

                                                    <button type="submit"
                                                        class="text-green-600 hover:text-green-800 text-xs font-semibold">
                                                        Kembalikan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                {{-- Jika tidak ada transaksi sama sekali, tampilkan baris kosong dengan pesan --}}
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                        Belum ada transaksi peminjaman.
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