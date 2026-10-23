<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Menampilkan daftar seluruh author dari Model
     */
    public function index()
    {
        // 1. Mengambil data array dari Model Author
        $authors = Author::all();

        // 2. Mengirimkan data ke View authors.index
        return view('authors.index', compact('authors'));
    }
}
