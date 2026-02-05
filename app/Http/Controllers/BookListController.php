<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class BookListController extends Controller
{
    public function index()
    {
        // Ambil semua buku sebagai koleksi Eloquent, bukan query builder/array
        $data = Book::with('categories')->get();

        return view('bookList.index', [
            'bookList' => $data,
        ]);
    }

    public function show(string $id)
    {
        $book = Book::with(['categories', 'review.user'])->findOrFail($id);
        // Hitung jumlah kolektor untuk buku ini (dari tabel collections)
        $book->loadCount(['collection as collectors_count']);
        $averageRating = $book->review->avg('rating') ?? 0;
        // Bulatkan rata-rata rating ke 1 desimal (contoh: 4.25 menjadi 4.3)

        $averageRating = round($averageRating, 1);
        // Cek apakah user yang sedang login sudah pernah review buku ini
        // Jika sudah, kita akan tampilkan form edit di view. Jika belum, tampilkan form create.
        $userReview = null;
        if (Auth::check()) {
            $userReview = Review::where('user_id', '=', Auth::id())
                ->where('book_id', '=', $book->id)
                ->first();
        }

        return view('bookList.show', [
            'book' => $book,
            'averageRating' => $averageRating,
            'userReview' => $userReview, // null jika belum login atau belum pernah review
        ]);
    }
}
