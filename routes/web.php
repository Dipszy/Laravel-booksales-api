<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

// Rute utama langsung mengarah ke daftar buku
Route::get('/', function () {
    return redirect('/books');
});

// Routing untuk Book dan Author
Route::get('/books', [BookController::class, 'index']);
Route::get('/authors', [AuthorController::class, 'index']);
