<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Menampilkan daftar author dari database (Eloquent)
     */
    public function index()
    {
        // Mengambil data author dari tabel database beserta relasi buku
        $authors = Author::with('books')->get();

        return view('authors.index', compact('authors'));
    }
}
