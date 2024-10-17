<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Event;
use App\Models\Gallery\Image;
use App\Models\Review;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __invoke()
    {
        return view('frontend.index', [
            'chefs' => Chef::latest()->take(3)->get(),
            'categories' => Category::latest()->get(),
            'events' => Event::where('status', 'active')->get(),
            'gallerys' => Image::latest()->get(),
            'reviews' => Review::latest()->take(5)->get(),
        ]);
    }
}
