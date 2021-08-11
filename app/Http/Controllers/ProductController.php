<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::latest()->filter(request(['search', 'price']));
        $categories = Category::all();
        $brands = Brand::paginate(5);
        return view('test', ['products' => $products->paginate(6), 'categories' => $categories, 'brands' => $brands]);
    }
    public function show(Product $product)
    {
        // dd($product);
        return view('showProduct', ['product' => $product]);
    }

    public function addProductToCart(Request $request, $id)
    {
        $prevCart = $request->session()->get('cart');
        $cart = new CartController($prevCart);
        $product = Product::find($id);
        $cart->addItem($id, $product);
        $request->session()->put('cart', $cart);
        return redirect()->route('root');
    }
    public function showCart()
    {
        $cart = Session::get('cart');
        if ($cart) {
            return view('cart', ['data' => $cart]);
        } else {
            echo "cart empty";
            return redirect()->route('root');
        }
    }
    public function deleteCart(Request $request, $id)
    {
        $cart = $request->session()->get('cart');
        if (array_key_exists($id, $cart->items)) {
            unset($cart->items[$id]);
        }
        $cart->update();
        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }
    public function incrSingleProduct(Request $request, $id)
    {
        $prevCart = $request->session()->get('cart');
        $product = Product::find($id);
        $prevCart->addItem($id, $product);
        $request->session()->put('cart', $prevCart);
        return redirect()->route('cart');
    }

    public function decrSingleProduct(Request $request, $id)
    {
        $prevCart = $request->session()->get('cart');
        if ($prevCart->items[$id]['quantity'] > 1) {
            $product = Product::find($id);
            $cleanPrice = (float)str_replace("$", "", $product->price);
            $prevCart->items[$id]['quantity'] = (float)($prevCart->items[$id]['quantity']) - 1;
            $prevCart->items[$id]['totalSinglePrice'] = (float)($prevCart->items[$id]['quantity']) * (float)$cleanPrice;
            $prevCart->update();
            $request->session()->put('cart', $prevCart);
        }
        return redirect()->route('cart');
    }
    public function createOrder(Request $request)
    {
        $cart = Session::get('cart');

        $first_name = $request->input('first_name');
        $address = $request->input('address');
        $last_name = $request->input('last_name');
        $zip = $request->input('zip');
        $phone = $request->input('phone');
        $email = $request->input('email');

        if ($cart) {
            $date = date('Y-m-d H:i:m');
            $newOrderArray = array("status" => "on_hold", "date" => $date, "del_date" => $date, "price" => $cart->totalPrice, "created_at" => DB::raw('CURRENT_TIMESTAMP'), "updated_at" => DB::raw('CURRENT_TIMESTAMP'), "first_name" => $first_name ? $first_name : null, "address" => $address ? $address : null, "last_name" => $last_name ? $last_name : null, "zip" => $zip ? $zip : null, "email" => $email ? $email : null, "phone" => $phone ? $phone : null);

            $createdOrder = DB::table('orders')->insert($newOrderArray);
            $orders_id = DB::getPdo()->lastInsertId();
            foreach ($cart->items as $item) {
                $item_id = $item['data']['id'];
                $item_name = $item['data']['name'];
                $item_price = $item['data']['price'];
                $newItemInCurrentOrder = array("product_id" => $item_id, "order_id" => $orders_id, "user_id" => auth()->id() ? auth()->id() : null, "product_name" => $item_name, "product_price" => str_replace("$", "", $item_price), "created_at" => DB::raw('CURRENT_TIMESTAMP'), "updated_at" => DB::raw('CURRENT_TIMESTAMP'));
                $created_order_details = DB::table('order_details')->insert($newItemInCurrentOrder);
            }
            Session::forget("cart");
            // if (auth()->id()) {
            // } else {
            //     Session::flush();
            // }
            $request->session()->put('payment_info', $newOrderArray);
            return redirect()->route('payment.index');
        } else {
            return redirect('/');
        }
    }
    public function checkoutProduct()
    {
        return view('checkoutproducts');
    }
}
