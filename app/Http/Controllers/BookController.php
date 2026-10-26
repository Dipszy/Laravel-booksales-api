<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku dari database (Eloquent)
     */
    public function index()
    {
        // Mengambil data buku dari tabel database beserta relasi author
        $books = Book::with('author')->get();

        return view('books.index', compact('books'));
    }
}
