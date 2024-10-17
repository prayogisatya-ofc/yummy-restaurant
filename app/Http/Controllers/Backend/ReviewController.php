<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:operator')->only('destroy');
    }
    
    public function index()
    {
        return view('backend.reviews.index', [
            'reviews' => Review::latest()->paginate(10),
        ]);
    }

    public function show(string $uuid)
    {
        return view('backend.reviews.show', [
            'review' => Review::where('uuid', $uuid)->firstOrFail(),
        ]);
    }

    public function destroy(string $uuid)
    {
        $review = Review::where('uuid', $uuid)->firstOrFail();

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully');
    }
}
