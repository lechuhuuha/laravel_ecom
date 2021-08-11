<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
    //
    public function category($name)
    {
        $products = Product::category($name);
        $categories = Category::all();
        $brands = Brand::paginate(5);
        return view('test', ['products' => $products->paginate(5), 'categories' => $categories, 'brands' => $brands]);
    }
    public function brand($name)
    {
        $products = Product::brand($name);
        $categories = Category::all();
        $brands = Brand::paginate(5);
        return view('test', ['products' => $products->paginate(5), 'categories' => $categories, 'brands' => $brands]);
    }
}
