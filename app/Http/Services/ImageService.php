<?php

namespace App\Http\Services;

use App\Models\Gallery\Image;

class ImageService
{
    public function select(int $paginate = null)
    {
        if ($paginate) {
            return Image::latest()->paginate($paginate);
        }
        
        return Image::latest()->get();
    }

    public function selectFirstBy(string $key, string $value)
    {
        return Image::where($key, $value)->firstOrFail();
    }
}