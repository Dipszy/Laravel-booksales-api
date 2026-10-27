<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

// Rute Pengujian Status API
Route::get('/health', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'BookSales API Service is Running'
    ], 200);
});

// Routing API untuk Book dan Author
Route::get('/books', [BookController::class, 'index']);
Route::get('/authors', [AuthorController::class, 'index']);
