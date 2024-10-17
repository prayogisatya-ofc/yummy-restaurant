<?php

namespace App\Http\Services;

use App\Models\Gallery\Video;

class VideoService
{
    public function select(int $paginate = null)
    {
        if ($paginate) {
            return Video::latest()->paginate($paginate);
        }
        
        return Video::latest()->get();
    }

    public function selectFirstBy(string $key, string $value)
    {
        return Video::where($key, $value)->firstOrFail();
    }
}