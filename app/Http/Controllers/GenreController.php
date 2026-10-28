<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Read all data genre (GET /api/genres)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $genres = Genre::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar data genre berhasil diambil',
            'data' => $genres
        ], 200);
    }

    /**
     * Create data genre baru (POST /api/genres)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // 1. Validasi input request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi data gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Simpan data baru ke database
        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // 3. Return response JSON 201 Created
        return response()->json([
            'status' => 'success',
            'message' => 'Data genre baru berhasil ditambahkan',
            'data' => $genre
        ], 201);
    }
}
