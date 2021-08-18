<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $lol = $user->order_details->first();
        $order = OrderDetails::where('user_id', auth()->user()->id)->get();
        $newOrder = $order->unique('order_id');
        return view('orders', ['users' => $user, 'order_details' => $newOrder]);
    }
    public function show($id)
    {
        $order_details = OrderDetails::where('order_id', $id)->get();
        // foreach ($order_details as $item) {
        //     if ($item->product->images->first()) {
        //         dump($item->product->images->first()->path);
        //     }
        // }
        // die();
        // dump($order_details);
        return view('ordershow', ['order' => $order_details]);
    }
}
