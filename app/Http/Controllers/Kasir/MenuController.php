<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Menu;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')
            ->latest()
            ->get();

        return view(
            'kasir.menus.index',
            compact('menus')
        );
    }

    public function create()
    {
        $categories = Category::all();

        return view(
            'kasir.menus.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store(
                    'menus',
                    'public'
                );
        }

        Menu::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()
            ->route('kasir.menus')
            ->with(
                'success',
                'Menu berhasil ditambahkan'
            );
    }

    public function edit($menuId)
    {
        $menu = Menu::findOrFail($menuId);

        $categories = Category::all();

        return view(
            'kasir.menus.edit',
            compact(
                'menu',
                'categories'
            )
        );
    }

    public function update(
        Request $request,
        $menuId
    ) {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu = Menu::findOrFail($menuId);

        $imagePath = $menu->image;

        if ($request->hasFile('image')) {

            if (
                $menu->image &&
                Storage::disk('public')->exists($menu->image)
            ) {
                Storage::disk('public')
                    ->delete($menu->image);
            }

            $imagePath = $request
                ->file('image')
                ->store(
                    'menus',
                    'public'
                );
        }

        $menu->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()
            ->route('kasir.menus')
            ->with(
                'success',
                'Menu berhasil diubah'
            );
    }

    public function destroy($menuId)
    {
        $menu = Menu::findOrFail($menuId);

        $menu->delete();

        return redirect()
            ->route('kasir.menus')
            ->with(
                'success',
                'Menu berhasil dihapus'
            );
    }
}