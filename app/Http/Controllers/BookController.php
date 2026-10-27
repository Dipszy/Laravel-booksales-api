<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku dalam format response JSON
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Mengambil seluruh data buku beserta relasi author-nya dari database
        $books = Book::with('author')->get();

        // Mengembalikan response JSON standar API
        return response()->json([
            'status' => 'success',
            'message' => 'Daftar data buku berhasil diambil',
            'data' => $books
        ], 200);
    }
}
