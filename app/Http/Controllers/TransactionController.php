<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin' || $user->role === 'petugas') {
            $data = Transaction::with(['book', 'user'])->get();
        } else {
            $data = Transaction::with(['book', 'user'])->where('user_id', '=', $user->id)->get();
        }

        return view('transactions.index', [
            'data' => $data,
        ]);
    }

    public function show(string $id)
    {
        $data = Transaction::with(['book.categories', 'user'])->findOrFail($id);

        return view('transactions.show', [
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'tanggal_pengembalian' => 'required|date|after:now',
        ]);
        $userId = Auth::id();
        $bookId = $validatedData['book_id'];
        $dueDate = $validatedData['tanggal_pengembalian'];
        $book = Book::findorFail($bookId);
        Transaction::create([
            'user_id' => $userId,
            'book_id' => $book->id,
            'tanggal_peminjaman' => now(),
            'tanggal_pengembalian' => $dueDate,
            'status' => 'dipinjam',
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi peminjaman buku berhasil dibuat');
    }

    public function returnBook(Transaction $transaction)
    {
        $currentUserId = Auth::id();
        if ($transaction->user_id !== $currentUserId) {
            abort(403, 'Anda tidak memiliki izin untuk mengembalikan transaksi ini');
        }
        $now = now();
        if ($now->greaterThan($transaction->tanggal_pengembalian)) {
            $newStatus = 'terlambat';
        } else {
            $newStatus = 'kembali';
        }
        $transaction->update([
            'status' => $newStatus,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Buku berhasil dikembalikan');
    }

    public function create(string $bookId)
    {
        $book = Book::with('categories')->findOrFail($bookId);

        return view('transactions.create', [
            'book' => $book,
        ]);
    }
}
