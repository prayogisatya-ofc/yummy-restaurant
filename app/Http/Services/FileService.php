<?php

namespace App\Http\Services;

use App\Models\Gallery\Image;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function upload($file, $path)
    {
        return $file->store($path, ['disk' => 'public']);
    }

    public function delete(string $path)
    {
        Storage::disk('public')->delete($path);
    }
}