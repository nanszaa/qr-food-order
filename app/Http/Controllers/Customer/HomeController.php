<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Table;

class HomeController extends Controller
{
   public function index()
{
    $categories = Category::all();

    $selectedCategory = request('category');

    $table = null;

    if (session('table_id')) {
        $table = Table::find(session('table_id'));
    }

    $menus = Menu::query()
        ->where('is_available', true);

    if ($selectedCategory) {
        $menus->where('category_id', $selectedCategory);
    }

    $menus = $menus->get();

    return view('customer.home', compact(
        'categories',
        'menus',
        'selectedCategory',
        'table'
    ));
}
    public function show(Menu $menu)
    {
        return view('customer.menu-detail', compact('menu'));
    }
}