<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {

        return view('admin.orders.index', ['orders' => Order::all()]);
    }
    public function show(Order $order)
    {
        // echo '<pre>';
        // foreach ($order->order_details as $item) {
        //     var_dump($item->user->name);
        // }
        // echo '</pre>';
        // die();
        return view('admin.orders.show', ['order' => $order]);
    }
}
