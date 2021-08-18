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
    public function delete(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index');
    }
    public function edit(Order $order)
    {
        return view('admin.orders.edit', ['order' => $order]);
    }
    public function update(Order $order)
    {
        $data = request()->validate([
            'first_name' => 'required|max:12',
            'address' => 'required|max:12',
            'email' => 'required|email',
            'last_name' => 'required|max:12',
            'phone' => 'required|max:12',
            'zip' => 'required|max:12',
        ]);
        $order->update($data);
        return redirect()->route('admin.orders.index');

    }
}
