<?php

namespace App\Models;
use App\Models\Book;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'review_text',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function book() {
        return $this->belongsTo(Book::class);
    }
    
}
