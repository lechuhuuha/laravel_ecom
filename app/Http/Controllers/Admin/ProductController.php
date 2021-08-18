<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::paginate(5);
        return view('admin.products.index', ['products' => $products]);
    }
    public function create()
    {
        $cates = Category::all();
        $brand = Brand::all();

        return view('admin.products.create', ['cates' => $cates, 'brands' => $brand]);
    }
    public function store()
    {
        $imgArr = [];
        $data = request()->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'brand_id' => 'required',
                'images' => 'required'
            ]
        );
        $user = Product::create($data);

        if (request()->hasFile('images')) {
            $images = request()->file('images');
            foreach ($images as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('images', $name, 'public');
                $imgObj =    Image::create([
                    'name' => $name,
                    'path' => $path
                ]);
                $user->images()->attach($imgObj->id);
            }
        }

        $user->categories()->attach($data['category_id']);
        $user->brands()->attach($data['brand_id']);
        return redirect()->route('admin.products.index');
    }
    public function edit(Product $product)
    {

        $cates = Category::all();
        $brand = Brand::all();
        return view('admin.products.edit', ['item' => $product, 'cates' => $cates, 'brands' => $brand]);
    }
    public function update(Product $product)
    {
        $data = request()->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'brand_id' => 'required',
            ]
        );

        if (request()->hasFile('images')) {
            $images = request()->file('images');
            foreach ($images as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('images', $name, 'public');
                $imgObj =    Image::create([
                    'name' => $name,
                    'path' => $path
                ]);
                $product->images()->attach($imgObj->id);
            }
        }

        $product->update($data);

        $product->categories()->sync($data['category_id']);

        $product->brands()->sync($data['brand_id']);


        return redirect()->route('admin.products.index');
    }
    public function search()
    {
        $products = Product::latest();

        if (request('name')) {
            $products->where('name', 'like', '%' . request('name') . '%');
        }
        return view('admin.products.index', ['products' => $products->paginate(5)]);
    }
    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
    public function changeStatus($id)
    {
        $order = Order::find($id);
        $data = request('status');

        if ($order->status != config('common.order.status.cho_duyet') && $data == config('common.order.status.cho_duyet')) {
            return response()->json(['message' => $order->status, 'responseCode' => 400]);
        } elseif ($data == config('common.order.status.da_giao')) {

            $order->delete();
            return response()->json(['message' => 'delivered', 'responseCode' => 200]);
        } elseif ($data == config('common.order.status.da_huy')) {
            $order->delete();
            return response()->json(['message' => 'deleted', 'responseCode' => 200]);
        } else {

            $order->status = $data;
            $order->save();
            return response()->json(['message' => $order->status, 'responseCode' => 200]);
        }
    }
}
