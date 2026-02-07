<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && $user->role !== 'petugas') {
            return redirect()->route('bookList.index');
        }
        $hour = now()->format('H');
        $greeting = match (true) {
            $hour < 11 => 'Selamat Pagi',
            $hour < 15 => 'Selamat Siang',
            $hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam'
        };

        $kategori_populer = Category::withCount(['books as transaction_count' => function ($query) {
            $query->join('transactions', 'books.id', '=', 'transactions.book_id');
        }])
            ->orderBy('transaction_count', 'desc')
            ->take(5)
            ->get();

        $data = [
            'greeting' => $greeting,
            'total_buku' => Book::count(),
            'total_user' => User::count(),
            'total_transaksi' => Transaction::count(),
            'total_buku_dipinjam' => Transaction::where('status', '=', 'dipinjam')->count(),
            'total_buku_dikembalikan' => Transaction::where('status', '=', 'kembali')->count(),
            'total_buku_terlambat_dikembalikan' => Transaction::where('status', '=', 'terlambat')->count(),
            'total_kategori' => Category::count(),
            'total_collection' => Collection::count(),
            'collection_terbaru' => Collection::with('book')->latest()->take(5)->get(),
            'transaksi_terbaru' => Transaction::latest()->take(5)->get(),
            'kategori_populer' => $kategori_populer,
            'total_rating' => Review::sum('rating'),
            'total_user_memberi_rating' => Review::count('rating'),
            'rata_rata_rating' => Review::avg('rating') ?? 0,
        ];

        return view('dashboard', $data);
    }
}
