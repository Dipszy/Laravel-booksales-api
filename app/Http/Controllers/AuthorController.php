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

        $author = Author::create([
            'name'  => $request->name,
            'photo' => $request->photo,
            'bio'   => $request->bio,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data author baru berhasil ditambahkan',
            'data' => $author
        ], 201);
    }

    /**
     * Show detail single data author (GET /api/authors/{id})
     *
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $author = Author::with('books')->find($id);

        // Validasi jika data author tidak ditemukan
        if (!$author) {
            return response()->json([
                'status' => 'error',
                'message' => "Data author dengan ID {$id} tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail data author berhasil ditemukan',
            'data' => $author
        ], 200);
    }

    /**
     * Update data author (PUT/PATCH /api/authors/{id})
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        // Validasi jika data author tidak ditemukan
        if (!$author) {
            return response()->json([
                'status' => 'error',
                'message' => "Data author dengan ID {$id} tidak ditemukan"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'  => 'sometimes|required|string|max:255',
            'photo' => 'sometimes|required|string',
            'bio'   => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi data gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $author->update($request->only(['name', 'photo', 'bio']));

        return response()->json([
            'status' => 'success',
            'message' => 'Data author berhasil diperbarui',
            'data' => $author
        ], 200);
    }

    /**
     * Destroy / Delete data author (DELETE /api/authors/{id})
     *
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $author = Author::find($id);

        // Validasi jika data author tidak ditemukan
        if (!$author) {
            return response()->json([
                'status' => 'error',
                'message' => "Data author dengan ID {$id} tidak ditemukan"
            ], 404);
        }

        $author->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data author berhasil dihapus'
        ], 200);
    }
}
