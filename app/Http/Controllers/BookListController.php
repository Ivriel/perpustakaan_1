<?php

namespace App\Http\Controllers;

use App\Models\Book;

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
        $book = Book::with('categories')->findOrFail($id);

        return view('bookList.show', [
            'book' => $book,
        ]);
    }
}
