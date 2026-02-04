<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Book::with('categories')->get();

        return view('books.index', [
            'books' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('books.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required|numeric',
            'categories' => 'required|array',
        ]);

        $imagePath = $request->file('image')->store('books', 'public');
        $validatedData['image'] = $imagePath;
        $book = Book::create(collect($validatedData)->except('categories')->all());
        $book->categories()->sync($request->input('categories', []));

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::with('categories')->findOrFail($id);
        $categories = Category::all();

        return view('books.edit', [
            'book' => $book,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required|numeric',
        ]);

        $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun_terbit']);
        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $data['image'] = $request->file('image')->store('books', 'public');
        }
        $book->update($data);
        $book->categories()->sync($request->input('categories', []));

        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }
        $book->delete();

        return redirect()->route('books.index');
    }
}
