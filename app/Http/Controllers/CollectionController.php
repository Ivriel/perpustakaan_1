<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->guard()->user();
        if ($user->role === 'pengunjung') {
            $data = Collection::with(['user', 'book.categories'])->where('user_id', '=', $user->id)->get();
        } else {
            $data = Collection::with(['user', 'book.categories'])->get();
        }

        return view('collections.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
        $userId = Auth::id();
        $bookId = $validatedData['book_id'];
        // Cek duplikat: satu buku hanya sekali per user di koleksi
        $alreadyExist = Collection::where('user_id', '=', $userId)->exists();
        if ($alreadyExist) {
            return redirect()->back()->with('error', 'Buku ini sudah ada di koleksi anda.');
        }
        Collection::create([
            'user_id' => $userId,
            'book_id' => $bookId,
        ]);

        return back()->with('success', 'Buku berhasil ditambahkan ke koleksi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        // findOrFail($id) sudah mengembalikan satu model; jangan pakai ->get() agar $data tetap satu instance (bukan Collection)
        $data = Collection::with(['user', 'book.categories'])->findOrFail($id);
        // Pengunjung hanya boleh lihat koleksi sendiri.
        if ($user->role === 'pengunjung' && $data->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin melihat koleksi ini.');
        }

        return view('collections.show', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $collection = Collection::findOrFail($id);
        $currentUser = Auth::user();
        if ($collection->user_id !== $currentUser->id) {
            abort(403, 'Anda tidak memiliki izin menghapus koleksi ini');
        }
        $collection->delete();

        return redirect()->route('collections.index')->with('success', 'Buku dihapus dari koleksi.');
    }
}
