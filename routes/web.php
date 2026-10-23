<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;

// Halaman utama langsung diarahkan ke daftar genre
Route::get('/', function () {
    return redirect('/genres');
});

// Routing untuk Genre dan Author
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/authors', [AuthorController::class, 'index']);
