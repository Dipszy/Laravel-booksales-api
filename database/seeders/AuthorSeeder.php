<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'name' => 'J.K. Rowling',
                'photo' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=150&auto=format&fit=crop&q=80',
                'bio' => 'Penulis novel asal Inggris, terkenal secara mendunia melalui serial petualangan Harry Potter.'
            ],
            [
                'name' => 'George R.R. Martin',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
                'bio' => 'Novelis dan penulis naskah asal Amerika Serikat, pencipta mahakarya fantasi A Song of Ice and Fire.'
            ],
            [
                'name' => 'Isaac Asimov',
                'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80',
                'bio' => 'Penulis legendaris dan profesor biokimia, pelopor utama karya sastra fiksi ilmiah modern.'
            ],
            [
                'name' => 'Tere Liye',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&auto=format&fit=crop&q=80',
                'bio' => 'Penulis produktif kenamaan Indonesia dengan puluhan novel fiksi lintas genre best seller.'
            ],
            [
                'name' => 'Andrea Hirata',
                'photo' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=150&auto=format&fit=crop&q=80',
                'bio' => 'Sastrawan Indonesia peraih penghargaan literatur internasional melalui tetralogi Laskar Pelangi.'
            ]
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
