<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
  
    
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
        ]);
    
        Review::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);
    
        return back();
    }
    
    public function edit(Review $review)
    {
        // $this->authorize('update', $review);
        return view('reviews.edit', compact('review'));
    }
    
    public function update(Request $request, Review $review)
    {
        
    
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
        ]);
    
        $review->update($request->only('rating', 'review_text'));
        return redirect()->route('books.index');
    }
    
    public function destroy(Review $review)
    {
      
        $review->delete();
        return back();
    }
    
}
