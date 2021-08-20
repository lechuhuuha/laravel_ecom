<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brands.index', ['brands' => Brand::paginate(5)]);
    }
    public function create()
    {
        return view('admin.brands.create');
    }
    public function store()
    {
        Brand::create(request()->except('_token'));
        return redirect()->route('admin.brands.index');
    }
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', ['item' => $brand]);
    }
    public function update(Brand $brand)
    {

        $brand->update(request()->except('_token '));
        return redirect()->route('admin.brands.index');
    }
    public function delete(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index');
    }
}
