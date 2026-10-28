<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Read all data author (GET /api/authors)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Mengambil semua data author beserta relasi bukunya
        $authors = Author::with('books')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar data author berhasil diambil',
            'data' => $authors
        ], 200);
    }

    /**
     * Create data author baru (POST /api/authors)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // 1. Validasi input request
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'photo' => 'required|string',
            'bio'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi data gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Simpan data author baru ke database
        $author = Author::create([
            'name'  => $request->name,
            'photo' => $request->photo,
            'bio'   => $request->bio,
        ]);

        // 3. Return response JSON 201 Created
        return response()->json([
            'status' => 'success',
            'message' => 'Data author baru berhasil ditambahkan',
            'data' => $author
        ], 201);
    }
}
