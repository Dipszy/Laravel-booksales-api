<?php

namespace App\Models;

class Genre
{
    /**
     * Data array statis 5 genre buku
     *
     * @var array
     */
    private static $genres = [
        [
            'id' => 1,
            'name' => 'Fiction',
            'description' => 'Karya sastra yang bersumber dari imajinasi dan cerita rekaan pengarang.'
        ],
        [
            'id' => 2,
            'name' => 'Non-Fiction',
            'description' => 'Karya literatur faktual berdasarkan realitas peristiwa atau data ilmiah.'
        ],
        [
            'id' => 3,
            'name' => 'Science Fiction',
            'description' => 'Karya fiksi spekulatif dengan konsep masa depan, sains, dan teknologi.'
        ],
        [
            'id' => 4,
            'name' => 'Mystery',
            'description' => 'Genre yang berfokus pada penyelidikan teka-teki kasus kriminal dan ketegangan.'
        ],
        [
            'id' => 5,
            'name' => 'Biography',
            'description' => 'Buku riwayat kisah perjalanan hidup dan perjuangan figur nyata inspiratif.'
        ]
    ];

    /**
     * Mengambil seluruh data genre
     *
     * @return array
     */
    public static function all()
    {
        return self::$genres;
    }
}
