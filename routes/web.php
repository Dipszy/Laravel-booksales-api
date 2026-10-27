<?php

use Illuminate\Support\Facades\Route;

// Halaman root diarahkan dengan response API info
Route::get('/', function () {
    return response()->json([
        'app' => 'BookSales API',
        'version' => '1.0.0',
        'message' => 'Silakan akses endpoint API melalui /api/books atau /api/authors'
    ]);
});
