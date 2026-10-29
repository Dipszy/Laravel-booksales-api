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

// Routing API menggunakan apiResource (otomatis membuat index, store, show, update, destroy)
Route::apiResource('genres', GenreController::class);
Route::apiResource('authors', AuthorController::class);

// Routing API Book
Route::apiResource('books', BookController::class);
