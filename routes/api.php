<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes - BookSales API
|--------------------------------------------------------------------------
| Aturan Akses Middleware:
| 1. Read All & Show (Genre, Author, Book) -> Public (Bebas diakses)
| 2. Create, Update, Destroy (Genre, Author, Book) -> Khusus Admin (Middleware 'admin')
| 3. Read All & Destroy (Transaction) -> Khusus Admin (Middleware 'admin')
| 4. Create, Update, Show (Transaction) -> Khusus Customer Terautentikasi (Middleware 'customer')
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
// 2. CUSTOMER PROTECTED ROUTES (Khusus Customer Terautentikasi)
// =========================================================================
Route::middleware(['customer'])->group(function () {
    // Create, Update, dan Show Transaksi hanya dapat diakses oleh Customer
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions/{id}', [TransactionController::class, 'show']);
    Route::put('/transactions/{id}', [TransactionController::class, 'update']);
    Route::patch('/transactions/{id}', [TransactionController::class, 'update']);
});


// =========================================================================
// 3. ADMIN PROTECTED ROUTES (Khusus Admin)
// =========================================================================
Route::middleware(['admin'])->group(function () {
    // Read All dan Destroy Transaksi hanya dapat diakses oleh Admin
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

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
