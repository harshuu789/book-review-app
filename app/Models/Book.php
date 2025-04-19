<?php

namespace App\Models;
use App\Models\Review;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        // Add more fields if you have like description, image, etc.
    ];
    //
    public function reviews() {
        return $this->hasMany(Review::class);
    }
    
}

