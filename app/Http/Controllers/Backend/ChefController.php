<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChefRequest;
use App\Http\Services\ChefService;
use App\Http\Services\FileService;
use App\Models\Chef;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    public function __construct(
        private ChefService $chefService,
        private FileService $fileService
    ){
        $this->middleware('checkRole:operator')->only('create', 'store', 'edit', 'update', 'destroy');
    }
    
    public function index()
    {
        return view('backend.chefs.index', [
            'chefs' => $this->chefService->select(10)
        ]);
    }

    public function create()
    {
        return view('backend.chefs.create');
    }

    public function store(ChefRequest $request)
    {
        $data = $request->validated();

        try {
            $data['photo'] = $this->fileService->upload($request->file('photo'), 'chefs');

            Chef::create($data);

            return redirect()->route('panel.chefs.index')->with('success', 'Chef created successfully');
        } catch (\Throwable $th) {
            $this->fileService->delete('chefs/' . $data['photo']);
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show(string $uuid)
    {
        return view('backend.chefs.show', [
            'chef' => $this->chefService->selectFirstBy('uuid', $uuid)
        ]);
    }

    public function edit(string $uuid)
    {
        return view('backend.chefs.edit', [
            'chef' => $this->chefService->selectFirstBy('uuid', $uuid)
        ]);
    }

    public function update(ChefRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getChef = $this->chefService->selectFirstBy('uuid', $uuid);

        try {
            if ($request->hasFile('photo')) {
                $this->fileService->delete($getChef->photo);
                $data['photo'] = $this->fileService->upload($request->file('photo'), 'chefs');
            }

            $getChef->update($data);

            return redirect()->route('panel.chefs.index')->with('success', 'Chef updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $uuid)
    {
        $chef = $this->chefService->selectFirstBy('uuid', $uuid);
        $this->fileService->delete($chef->photo);
        $chef->delete();

        return redirect()->route('panel.chefs.index')->with('success', 'Chef deleted successfully');
    }
}
