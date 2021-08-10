<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Product $product)
    {
        // dd(request()->all());
        request()->validate([
            'body' => 'required'
        ]);
        $product->comments()->create([
            'user_id' => auth()->id(),
            'body' => request('body')
        ]);
        return redirect()->route('product.show', $product->id);
    }
}
