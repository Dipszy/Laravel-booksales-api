<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes - BookSales API
|--------------------------------------------------------------------------
| Aturan Akses Middleware:
| 1. Read All (index) & Show detail -> Public (Bisa diakses siapa saja)
| 2. Create (store), Update (update), Destroy (destroy) -> Khusus Admin (Middleware 'admin')
|--------------------------------------------------------------------------
*/

// Health Check Endpoint
Route::get('/health', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'BookSales API Service is Running'
    ], 200);
});

// =========================================================================
// 1. PUBLIC ROUTES (Tanpa Autentikasi / Bebas Diakses Semua Orang)
// =========================================================================

// Read All & Show Genre
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{id}', [GenreController::class, 'show']);

// Read All & Show Author
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);

// Read All & Show Book
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);


// =========================================================================
// 2. PROTECTED ROUTES (Hanya Dapat Diakses oleh User Ber-role Admin)
// =========================================================================
Route::middleware(['admin'])->group(function () {
    // Create, Update, Destroy Genre
    Route::post('/genres', [GenreController::class, 'store']);
    Route::put('/genres/{id}', [GenreController::class, 'update']);
    Route::patch('/genres/{id}', [GenreController::class, 'update']);
    Route::delete('/genres/{id}', [GenreController::class, 'destroy']);

    // Create, Update, Destroy Author
    Route::post('/authors', [AuthorController::class, 'store']);
    Route::put('/authors/{id}', [AuthorController::class, 'update']);
    Route::patch('/authors/{id}', [AuthorController::class, 'update']);
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);

    // Create, Update, Destroy Book
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::patch('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
});
