<?php

namespace App\Http\Controllers\Client\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToCartController extends Controller
{

    public function __invoke()
    {
        $userId = Auth::id();
        $cart_items = Cart::where('user_id', $userId)->get();
        return view('user_template.add_to_cart', compact('cart_items'));

    }
}
