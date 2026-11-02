<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Read All: Menampilkan seluruh riwayat transaksi (Khusus Admin)
     * Mengambil data relasi dari Model Customer (User) dan Book
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Mengambil seluruh transaksi beserta relasi customer dan buku
        $transactions = Transaction::with(['customer', 'book'])->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar seluruh transaksi berhasil diambil (Akses Admin)',
            'data' => $transactions
        ], 200);
    }

    /**
     * Create: Membuat transaksi pembelian baru (Khusus Customer terautentikasi)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // 1. Validasi input request
        $validator = Validator::make($request->all(), [
            'book_id'      => 'required|exists:books,id',
            'qty'          => 'required|integer|min:1',
            'order_number' => 'nullable|string|unique:transactions,order_number',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi data gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Ambil user customer yang sedang terautentikasi
        $user = $request->user();
        $customer_id = $user ? $user->id : $request->input('customer_id');

        // 3. Periksa ketersediaan buku & kalkulasi total harga
        $book = Book::find($request->book_id);
        $qty = (int)$request->qty;

        if ($book->stock < $qty) {
            return response()->json([
                'status' => 'error',
                'message' => "Stok buku tidak mencukupi. Sisa stok tersedia: {$book->stock}"
            ], 400);
        }

        $total_amount = $book->price * $qty;
        $order_number = $request->order_number ?: 'ORD-' . strtoupper(Str::random(8));

        // 4. Simpan transaksi baru
        $transaction = Transaction::create([
            'order_number' => $order_number,
            'customer_id'  => $customer_id,
            'book_id'      => $book->id,
            'qty'          => $qty,
            'total_amount' => $total_amount,
        ]);

        // Kurangi stok buku secara otomatis
        $book->decrement('stock', $qty);

        // Ambil data relasi Model customer dan book
        $transaction->load(['customer', 'book']);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi baru berhasil dibuat',
            'data' => $transaction
        ], 201);
    }

    /**
     * Show: Menampilkan detail transaksi spesifik (Khusus Customer terautentikasi)
     *
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Mengambil transaksi dengan relasi customer dan book
        $transaction = Transaction::with(['customer', 'book'])->find($id);

        // Validasi jika data tidak ditemukan
        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => "Data transaksi dengan ID {$id} tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail data transaksi berhasil ditemukan',
            'data' => $transaction
        ], 200);
    }

    /**
     * Update: Memperbarui data transaksi (Khusus Customer terautentikasi)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        // Validasi jika data tidak ditemukan
        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => "Data transaksi dengan ID {$id} tidak ditemukan"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'book_id'      => 'sometimes|required|exists:books,id',
            'qty'          => 'sometimes|required|integer|min:1',
            'order_number' => "sometimes|required|string|unique:transactions,order_number,{$id}",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi data gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Kalkulasi ulang total jika book_id atau qty berubah
        $book_id = $request->input('book_id', $transaction->book_id);
        $qty     = $request->input('qty', $transaction->qty);

        $book = Book::find($book_id);
        $total_amount = $book->price * $qty;

        $transaction->update([
            'book_id'      => $book_id,
            'qty'          => $qty,
            'total_amount' => $total_amount,
            'order_number' => $request->input('order_number', $transaction->order_number),
        ]);

        $transaction->load(['customer', 'book']);

        return response()->json([
            'status' => 'success',
            'message' => 'Data transaksi berhasil diperbarui',
            'data' => $transaction
        ], 200);
    }

    /**
     * Destroy: Menghapus data transaksi (Khusus Admin)
     *
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        // Validasi jika data tidak ditemukan
        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => "Data transaksi dengan ID {$id} tidak ditemukan"
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data transaksi berhasil dihapus (Akses Admin)'
        ], 200);
    }
}
