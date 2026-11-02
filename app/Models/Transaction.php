<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'order_number',
        'customer_id',
        'book_id',
        'qty',
        'total_amount',
    ];

    /**
     * Relasi ke model User (sebagai customer)
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Relasi ke model Book
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
