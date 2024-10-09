<?php

namespace App\Http\Services;

use App\Models\Menu;

class MenuService
{
    public function select(int $paginate = null)
    {
        if ($paginate) {
            return Menu::latest()->paginate($paginate);
        }
        
        return Menu::latest()->get();
    }

    public function selectFirstBy(string $key, string $value)
    {
        return Menu::where($key, $value)->firstOrFail();
    }
}