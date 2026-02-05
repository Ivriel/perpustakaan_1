<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:1000',
        ]);
        $userId = Auth::id();
        $bookId = $validatedData['book_id'];

        // Cek apakah user ini sudah pernah review buku ini sebelumnya
        // Jika sudah ada, kita akan update review yang sudah ada (bukan buat baru) untuk mencegah duplikat
        $existingReview = Review::where('user_id', '=', $userId)
            ->where('book_id', '=', $bookId)
            ->first();

        if ($existingReview) {
            // Jika sudah ada review sebelumnya, update review yang sudah ada dengan data baru
            $existingReview->update([
                'rating' => $validatedData['rating'],
                'ulasan' => $validatedData['ulasan'],
            ]);

            return redirect()->route('bookList.show', $bookId)->with('success', 'Ulasan Anda berhasil diperbarui');
        } else {
            // Jika belum pernah review, buat review baru dengan data yang sudah divalidasi
            Review::create([
                'user_id' => $userId,
                'book_id' => $bookId,
                'rating' => $validatedData['rating'],
                'ulasan' => $validatedData['ulasan'],
            ]);

            return redirect()->route('bookList.show', $bookId)->with('success', 'Ulasan Anda berhasil ditambahkan');
        }
    }

    // * Hanya bisa update review milik sendiri.
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:1000',
        ]);

        $review = Review::findOrFail($id);
        // Pastikan hanya pemilik review yang bisa mengupdate (security check)
        // Jika user yang login bukan pemilik review ini, kembalikan error 403 Forbidden
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin mengubah ulasan ini');
        }

        $review->update([
            'rating' => $validatedData['rating'],
            'ulasan' => $validatedData['ulasan'],
        ]);

        return redirect()->route('bookList.show', $review->book_id)->with('success', 'Ulasan anda berhasil diperbarui');
    }

    // * Hanya bisa hapus review milik sendiri.
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin menghapus ulasan ini');
        }
        $bookId = $review->book_id;
        $review->delete();

        return redirect()->route('bookList.show', $bookId)->with('success', 'Ulasan anda berhasil dihapus');
    }
}
