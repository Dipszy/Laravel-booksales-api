<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

// Health Check
Route::get('/health', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'BookSales API Service is Running'
    ], 200);
});

// Routing API Genre (Read All & Create)
Route::get('/genres', [GenreController::class, 'index']);
Route::post('/genres', [GenreController::class, 'store']);

// Routing API Author (Read All & Create)
Route::get('/authors', [AuthorController::class, 'index']);
Route::post('/authors', [AuthorController::class, 'store']);

// Routing API Book
Route::get('/books', [BookController::class, 'index']);
