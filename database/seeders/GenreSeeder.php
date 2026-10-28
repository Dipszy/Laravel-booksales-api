<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            [
                'name' => 'Fiction',
                'description' => 'Karya sastra imajinatif dan cerita rekaan pengarang.'
            ],
            [
                'name' => 'Non-Fiction',
                'description' => 'Karya literatur faktual berdasarkan peristiwa atau data ilmiah nyata.'
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Karya fiksi spekulatif dengan tema eksplorasi teknologi dan masa depan.'
            ],
            [
                'name' => 'Mystery',
                'description' => 'Kisah teka-teki kriminal, penyelidikan detektif, dan suspense.'
            ],
            [
                'name' => 'Biography',
                'description' => 'Kisah riwayat hidup tokoh nyata yang menginspirasi.'
            ]
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
