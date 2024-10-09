<?php

namespace App\Http\Services;

use App\Models\Chef;

class ChefService
{
    public function select(int $paginate = null)
    {
        if ($paginate) {
            return Chef::latest()->paginate($paginate);
        }
        
        return Chef::latest()->get();
    }

    public function selectFirstBy(string $key, string $value)
    {
        return Chef::where($key, $value)->firstOrFail();
    }
}