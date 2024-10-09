<?php

namespace App\Http\Services;

use App\Models\Event;

class EventService
{
    public function select(int $paginate = null)
    {
        if ($paginate) {
            return Event::latest()->paginate($paginate);
        }
        
        return Event::latest()->get();
    }

    public function selectFirstBy(string $key, string $value)
    {
        return Event::where($key, $value)->firstOrFail();
    }
}