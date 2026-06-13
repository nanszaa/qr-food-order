<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view(
            'kasir.categories.index',
            compact('categories')
        );
    }

    public function create()
    {
        return view(
            'kasir.categories.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
        ]);

        return redirect()
            ->route('kasir.categories')
            ->with(
                'success',
                'Kategori berhasil ditambahkan'
            );
    }

    public function edit($categoryId)
    {
        $category = Category::findOrFail(
            $categoryId
        );

        return view(
            'kasir.categories.edit',
            compact('category')
        );
    }

    public function update(Request $request, $categoryId)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = Category::findOrFail(
            $categoryId
        );

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug(
                $request->name
            ),
        ]);

        return redirect()
            ->route('kasir.categories')
            ->with(
                'success',
                'Kategori berhasil diubah'
            );
    }

    public function destroy($categoryId)
    {
        $category = Category::findOrFail(
            $categoryId
        );

        $category->delete();

        return redirect()
            ->route('kasir.categories')
            ->with(
                'success',
                'Kategori berhasil dihapus'
            );
    }
}