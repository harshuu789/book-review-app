<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Books</h1>

        {{-- Sort Dropdown --}}
        <div class="mb-4">
            <label for="sortSelect" class="mr-4">Sort by Rating:</label>
            <select id="sortSelect" class="border px-8 py-1 rounded">
                <option value="default">-- Select --</option>
                <option value="high">Highest to Lowest</option>
                <option value="low">Lowest to Highest</option>
            </select>
        </div>

        {{-- Books Container --}}
        <div id="booksContainer">
            @foreach ($books as $book)
                <div class="book-card mt-6 p-4 bg-white shadow rounded" data-rating="{{ round($book->reviews->avg('rating'), 1) }}">
                    <h2 class="text-xl">{{ $book->title }} <small>by {{ $book->author }}</small></h2>
                    <p>Average Rating: {{ round($book->reviews->avg('rating'), 1) }}/5</p>

                    <h3 class="mt-4 font-semibold">Reviews:</h3>
                    @forelse ($book->reviews as $review)
                        <div class="mt-2 p-2 border rounded">
                            <strong>{{ $review->user->name }}</strong> - {{ $review->rating }}/5<br>

                            @auth
                                @if (auth()->id() === $review->user_id && request('edit') == $review->id)
                                    <form method="POST" action="{{ route('reviews.update', $review) }}">
                                        @csrf
                                        @method('PUT')
                                        <label>Rating:</label>
                                        <select name="rating" class="ml-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}" @if($i == $review->rating) selected @endif>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <br>
                                        <label>Review:</label><br>
                                        <textarea name="review_text" class="w-full mt-1 border p-2 rounded">{{ $review->review_text }}</textarea>
                                        <div class="mt-2 flex gap-2">
                                            <button class="px-4 py-1 bg-blue-500 text-white rounded">Update</button>
                                            <a href="{{ url()->current() }}" class="px-4 py-1 bg-gray-200 rounded">Cancel</a>
                                        </div>
                                    </form>
                                @else
                                    <p>{{ $review->review_text }}</p>
                                    @if(auth()->id() === $review->user_id)
                                        <div class="mt-1">
                                            <a href="{{ url()->current() }}?edit={{ $review->id }}" class="text-blue-500 mr-2">Edit</a>
                                            <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                                @csrf @method('DELETE')
                                                <button class="text-red-500">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            @else
                                <p>{{ $review->review_text }}</p>
                            @endauth
                        </div>
                    @empty
                        <p class="text-gray-500">No reviews yet.</p>
                    @endforelse

                    {{-- Add Review --}}
                    @auth
                        @php
                            $userReviewed = $book->reviews->where('user_id', auth()->id())->first();
                        @endphp

                        @if (!$userReviewed)
                            <form method="POST" action="{{ route('reviews.store') }}" class="mt-4">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">

                                <label>Rating:</label>
                                <select name="rating" class="ml-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>

                                <br>
                                <label>Review:</label><br>
                                <textarea name="review_text" class="w-full mt-1 border rounded p-2" rows="3"></textarea>

                                <button class="mt-2 px-4 py-1 bg-green-500 text-white rounded">Submit</button>
                            </form>
                        @else
                            <p class="mt-2 text-sm text-gray-500">You’ve already submitted a review for this book.</p>
                        @endif
                    @else
                        <p class="text-sm text-gray-600 mt-2">Please <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> to leave a review.</p>
                    @endauth
                </div>
            @endforeach
        </div>
    </div>

  
    <script>
        const sortSelect = document.getElementById('sortSelect');
        const booksContainer = document.getElementById('booksContainer');

        sortSelect.addEventListener('change', function () {
            const sortValue = this.value;
            const cards = Array.from(booksContainer.querySelectorAll('.book-card'));

            if (sortValue === 'high') {
                cards.sort((a, b) => parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating));
            } else if (sortValue === 'low') {
                cards.sort((a, b) => parseFloat(a.dataset.rating) - parseFloat(b.dataset.rating));
            } else {
                return; // Do nothing if default
            }

            // Re-append sorted cards
            cards.forEach(card => booksContainer.appendChild(card));
        });
    </script>
</x-app-layout>
