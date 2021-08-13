<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public $items;
    public $totalQuantity;
    public $totalPrice;
    public function __construct($prevCart)
    {
        if ($prevCart != null) {
            $this->items = $prevCart->items;
            $this->totalQuantity = $prevCart->totalQuantity;
            $this->totalPrice = $prevCart->totalPrice;
        } else {
            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
        }
    }
    public function addItem($id, $product, $quantity = 1)
    {
        $price = (int)str_replace("$", "", $product->price);
        if (array_key_exists($id, $this->items)) {
            $productToAdd = $this->items[$id];
            if ($quantity == 1) {
                $productToAdd['quantity']++;
            } else {
                $productToAdd['quantity'] += $quantity;
            }
            $productToAdd['totalSinglePrice'] = $productToAdd['quantity'] * $price;
        } else {
            $productToAdd = ['quantity' => $quantity, 'totalSinglePrice' => $price * $quantity, 'data' => $product];
            $this->totalQuantity++;
        }
        $this->items[$id] = $productToAdd;
        $this->totalPrice = $this->totalPrice + $productToAdd['totalSinglePrice'];
    }
    public function update()
    {
        $totalPrice = 0;
        $totalQuantity = 0;
        foreach ($this->items as $item) {
            $totalQuantity = $totalQuantity + $item['quantity'];
            $totalPrice = $totalPrice + $item['totalSinglePrice'];
        }
        $this->totalQuantity = $totalQuantity;
        $this->totalPrice = $totalPrice;
    }
}
