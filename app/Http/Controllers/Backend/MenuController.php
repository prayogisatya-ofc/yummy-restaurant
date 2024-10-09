<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Http\Services\CategoryService;
use App\Http\Services\FileService;
use App\Http\Services\MenuService;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(
        private FileService $fileService,
        private MenuService $menuService,
        private CategoryService $categoryService
    ){}

    public function index()
    {
        return view('backend.menus.index', [
            'menus' => $this->menuService->select(10)
        ]);
    }

    public function create()
    {
        return view('backend.menus.create', [
            'categories' => $this->categoryService->select()
        ]);
    }

    public function store(MenuRequest $request)
    {
        $data = $request->validated();

        try {
            $data['image'] = $this->fileService->upload($request->file('image'), 'menus');

            Menu::create($data);

            return redirect()->route('panel.menus.index')->with('success', 'Menu created successfully');
        } catch (\Throwable $th) {
            $this->fileService->delete('menus/' . $data['image']);
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show(string $uuid)
    {
        return view('backend.menus.show', [
            'menu' => $this->menuService->selectFirstBy('uuid', $uuid),
        ]);
    }

    public function edit(string $uuid)
    {
        return view('backend.menus.edit', [
            'menu' => $this->menuService->selectFirstBy('uuid', $uuid),
            'categories' => $this->categoryService->select()
        ]);
    }

    public function update(MenuRequest $request, string $uuid)
    {
        $data = $request->validated();

        $getMenu = $this->menuService->selectFirstBy('uuid', $uuid);

        try {
            if ($request->hasFile('image')) {
                $this->fileService->delete($getMenu->file);
                $data['image'] = $this->fileService->upload($request->file('image'), 'menus');
            }

            $getMenu->update($data);

            return redirect()->route('panel.menus.index')->with('success', 'Menu updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $uuid)
    {
        $menu = Menu::where('uuid', $uuid)->firstOrFail();
        $this->fileService->delete($menu->image);
        $menu->delete();

        return redirect()->back()->with('success', 'Menu deleted successfully');
    }
}
