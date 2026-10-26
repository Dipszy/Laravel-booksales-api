<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'description' => 'Awal mula petualangan Harry Potter memasuki dunia sihir Hogwarts.',
                'price' => 95000.00,
                'stock' => 45,
                'cover_photo' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300&auto=format&fit=crop&q=80',
                'author_id' => 1,
            ],
            [
                'title' => 'A Game of Thrones',
                'description' => 'Konflik intrik politik dan perebutan tahta besi di daratan fiksi Westeros.',
                'price' => 125000.00,
                'stock' => 30,
                'cover_photo' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300&auto=format&fit=crop&q=80',
                'author_id' => 2,
            ],
            [
                'title' => 'Foundation',
                'description' => 'Kisah keruntuhan dan kebangkitan imperium galaksi melalui ilmu psikohistori.',
                'price' => 88000.00,
                'stock' => 25,
                'cover_photo' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=300&auto=format&fit=crop&q=80',
                'author_id' => 3,
            ],
            [
                'title' => 'Bumi',
                'description' => 'Kisah petualangan tiga sahabat remaja menjelajahi klan dunia paralel.',
                'price' => 85000.00,
                'stock' => 50,
                'cover_photo' => 'https://images.unsplash.com/photo-1532012164546-f432f2e3777a?w=300&auto=format&fit=crop&q=80',
                'author_id' => 4,
            ],
            [
                'title' => 'Laskar Pelangi',
                'description' => 'Inspirasi perjuangan sepuluh anak di Belitung dalam menggapai cita-cita pendidikan.',
                'price' => 78000.00,
                'stock' => 35,
                'cover_photo' => 'https://images.unsplash.com/photo-1495640388908-05fa85288e61?w=300&auto=format&fit=crop&q=80',
                'author_id' => 5,
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
