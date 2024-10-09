<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService
{
    public function select()
    {
        return Category::latest()->get();
    }
}