<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookListController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class)->except('show')->middleware('role:admin,petugas');
    Route::resource('books', BookController::class)->middleware('role:admin,petugas');
    Route::resource('collections', CollectionController::class)->except('create', 'edit', 'update');
    Route::get('bookList', [BookListController::class, 'index'])->name('bookList.index');
    Route::get('bookList/{id}', [BookListController::class, 'show'])->name('bookList.show');
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/create/{id}', [TransactionController::class, 'create'])->name('transactions.create');
    Route::get('transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::post('transactions/{transaction}/return', [TransactionController::class, 'returnBook'])->name('transactions.returnBook');
    Route::get('transaction/print/{id}', [TransactionController::class, 'printReceipt'])->name('transaction.print');
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::put('reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
