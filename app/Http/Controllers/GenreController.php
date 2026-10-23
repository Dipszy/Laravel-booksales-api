<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Menampilkan daftar seluruh genre dari Model
     */
    public function index()
    {
        // 1. Mengambil data array dari Model Genre
        $genres = Genre::all();

        // 2. Mengirimkan data ke View genres.index
        return view('genres.index', compact('genres'));
    }
}
