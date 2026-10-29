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

        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data genre baru berhasil ditambahkan',
            'data' => $genre
        ], 201);
    }

    /**
     * Show detail single data genre (GET /api/genres/{id})
     *
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $genre = Genre::find($id);

        // Validasi jika data yang dicari tidak ditemukan
        if (!$genre) {
            return response()->json([
                'status' => 'error',
                'message' => "Data genre dengan ID {$id} tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail data genre berhasil ditemukan',
            'data' => $genre
        ], 200);
    }

    /**
     * Update data genre (PUT/PATCH /api/genres/{id})
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        // Validasi jika data yang ingin diubah tidak ditemukan
        if (!$genre) {
            return response()->json([
                'status' => 'error',
                'message' => "Data genre dengan ID {$id} tidak ditemukan"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi data gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $genre->update($request->only(['name', 'description']));

        return response()->json([
            'status' => 'success',
            'message' => 'Data genre berhasil diperbarui',
            'data' => $genre
        ], 200);
    }

    /**
     * Destroy / Delete data genre (DELETE /api/genres/{id})
     *
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $genre = Genre::find($id);

        // Validasi jika data yang ingin dihapus tidak ditemukan
        if (!$genre) {
            return response()->json([
                'status' => 'error',
                'message' => "Data genre dengan ID {$id} tidak ditemukan"
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data genre berhasil dihapus'
        ], 200);
    }
}
