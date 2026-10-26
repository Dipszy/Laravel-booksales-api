<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'cover_photo',
        'author_id',
    ];

    /**
     * Relasi ke model Author (Belongs-to)
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
