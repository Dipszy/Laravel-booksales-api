<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Book;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::where('role', 'customer')->first();
        $books = Book::take(3)->get();

        if ($customer && $books->count() > 0) {
            Transaction::create([
                'order_number' => 'ORD-0001',
                'customer_id'  => $customer->id,
                'book_id'      => $books[0]->id,
                'qty'          => 1,
                'total_amount' => $books[0]->price * 1,
            ]);

            if (isset($books[1])) {
                Transaction::create([
                    'order_number' => 'ORD-0002',
                    'customer_id'  => $customer->id,
                    'book_id'      => $books[1]->id,
                    'qty'          => 2,
                    'total_amount' => $books[1]->price * 2,
                ]);
            }
        }
    }
}
