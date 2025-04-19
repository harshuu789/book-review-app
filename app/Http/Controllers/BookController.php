<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');
    
        $books = Book::with(['reviews' => function ($query) use ($sort) {
            if ($sort == 'high') {
                $query->orderByDesc('rating');
            } elseif ($sort == 'low') {
                $query->orderBy('rating');
            }
        }, 'reviews.user'])->get();
    
        return view('books.index', compact('books'));
    }
    
}
