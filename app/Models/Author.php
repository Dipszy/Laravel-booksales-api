<?php

namespace App\Models;

class Author
{
    /**
     * Data array statis 5 author / pengarang buku
     *
     * @var array
     */
    private static $authors = [
        [
            'id' => 1,
            'name' => 'J.K. Rowling',
            'photo' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=150&auto=format&fit=crop&q=80',
            'bio' => 'Penulis novel asal Inggris, terkenal secara mendunia melalui serial Harry Potter.'
        ],
        [
            'id' => 2,
            'name' => 'George R.R. Martin',
            'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
            'bio' => 'Novelis dan penulis naskah asal Amerika Serikat, pencipta mahakarya A Song of Ice and Fire.'
        ],
        [
            'id' => 3,
            'name' => 'Isaac Asimov',
            'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80',
            'bio' => 'Penulis legendaris dan profesor biokimia, pelopor sastra fiksi ilmiah modern.'
        ],
        [
            'id' => 4,
            'name' => 'Tere Liye',
            'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&auto=format&fit=crop&q=80',
            'bio' => 'Penulis produktif kenamaan Indonesia dengan puluhan novel lintas genre best seller.'
        ],
        [
            'id' => 5,
            'name' => 'Andrea Hirata',
            'photo' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=150&auto=format&fit=crop&q=80',
            'bio' => 'Sastrawan Indonesia peraih penghargaan internasional melalui tetralogi Laskar Pelangi.'
        ]
    ];

    /**
     * Mengambil seluruh data author
     *
     * @return array
     */
    public static function all()
    {
        return self::$authors;
    }
}
