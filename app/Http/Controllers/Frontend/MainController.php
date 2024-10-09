<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Event;
use App\Models\Gallery\Image;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('frontend.index', [
            'chefs' => Chef::latest()->take(3)->get(),
            'categories' => Category::latest()->get(),
            'events' => Event::where('status', 'active')->get(),
            'gallerys' => Image::latest()->get(),
        ]);
    }
}
