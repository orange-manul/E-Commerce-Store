<?php

namespace App\Http\Controllers\Client\Order;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function __invoke()
    {
        $userId = Auth::id();
        $cart_items = Cart::where('user_id', $userId)->get();
        $shipping_address = ShippingInfo::where('user_id', $userId)->first();
        return view('user_template.checkout', compact('shipping_address','cart_items'));

    }
}
