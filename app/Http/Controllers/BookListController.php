<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookListController extends Controller
{
    public function index()
    {
        $data = Book::with('categories');

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
