<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('admin.categories.index', ['categories' => Category::paginate(5)]);
    }
    public function create()
    {
        return view('admin.categories.create');
    }
    public function store()
    {
        Category::create(request()->except('_token'));
        return redirect()->route('admin.categories.index');
    }
    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['item' => $category]);
    }
    public function update(Category $category)
    {

        $category->update(request()->except('_token '));
        return redirect()->route('admin.categories.index');
    }
    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
