<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Services\FileService;
use App\Http\Services\ImageService;
use App\Models\Gallery\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct(
        private FileService $fileService,
        private ImageService $imageService
    ){}

    public function index()
    {
        return view('backend.images.index', [
            'images' => $this->imageService->select(10),
        ]);
    }

    public function create()
    {
        return view('backend.images.create');
    }

    public function store(ImageRequest $request)
    {
        $data = $request->validated();

        try {
            $data['file'] = $this->fileService->upload($request->file('file'), 'images');

            Image::create($data);

            return redirect()->route('panel.images.index')->with('success', 'Image created successfully');
        } catch (\Throwable $th) {
            $this->fileService->delete('images/' . $data['file']);
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $uuid)
    {
        return view('backend.images.edit', [
            'image' => $this->imageService->selectFirstBy('uuid', $uuid),
        ]);
    }

    public function update(ImageRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getImage = $this->imageService->selectFirstBy('uuid', $uuid);

        try {
            if ($request->hasFile('file')) {
                $this->fileService->delete($getImage->file);
                $data['file'] = $this->fileService->upload($request->file('file'), 'images');
            }

            $getImage->update($data);

            return redirect()->route('panel.images.index')->with('success', 'Image updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $uuid)
    {
        $image = Image::where('uuid', $uuid)->firstOrFail();
        $this->fileService->delete($image->file);
        $image->delete();

        return redirect()->route('panel.images.index')->with('success', 'Image deleted successfully');
    }
}
