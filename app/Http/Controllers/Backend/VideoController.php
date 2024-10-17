<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Http\Services\VideoService;
use App\Models\Gallery\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct(
        private VideoService $videoService
    ){
        $this->middleware('checkRole:operator')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    public function index()
    {
        return view('backend.videos.index', [
            'videos' => $this->videoService->select(10)
        ]);
    }

    public function create()
    {
        return view('backend.videos.create');
    }

    public function store(VideoRequest $request)
    {
        $data = $request->validated();

        try {
            Video::create($data);

            return redirect()->route('panel.videos.index')->with('success', 'Video created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show(string $uuid)
    {
        return view('backend.videos.show', [
            'video' => $this->videoService->selectFirstBy('uuid', $uuid),
        ]);
    }

    public function edit(string $uuid)
    {
        return view('backend.videos.edit', [
            'video' => $this->videoService->selectFirstBy('uuid', $uuid),
        ]);
    }

    public function update(VideoRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getVideo = $this->videoService->selectFirstBy('uuid', $uuid);

        try {
            $getVideo->update($data);

            return redirect()->route('panel.videos.index')->with('success', 'Video updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $uuid)
    {
        $video = Video::where('uuid', $uuid)->firstOrFail();
        $video->delete();

        return redirect()->route('panel.videos.index')->with('success', 'Video deleted successfully');
    }
}
