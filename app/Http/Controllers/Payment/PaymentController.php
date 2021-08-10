<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    //
    public function showPaymentPage()
    {
        $payment_info = Session::get('payment_info');
        if ($payment_info['status'] == 'on_hold') {
            return view('payment.paymentpage', ['data' => $payment_info]);
        } else {
            echo "cart empty";
            return redirect()->route('root');
        }
        Session::forget('cart');
    }
}
