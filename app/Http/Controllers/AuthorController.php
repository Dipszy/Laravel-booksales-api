<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Menampilkan daftar author dalam format response JSON
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Mengambil seluruh data author beserta relasi bukunya dari database
        $authors = Author::with('books')->get();

        // Mengembalikan response JSON standar API
        return response()->json([
            'status' => 'success',
            'message' => 'Daftar data author berhasil diambil',
            'data' => $authors
        ], 200);
    }
}
