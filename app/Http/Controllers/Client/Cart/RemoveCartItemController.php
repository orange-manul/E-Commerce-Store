<?php

namespace App\Http\Controllers\Client\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class RemoveCartItemController extends Controller
{
    public function __invoke($id)
    {
        Cart::findOrFail($id)->delete();

        return redirect()->route('add_to_cart')->with('message', 'Your item remove from cart successfully');

    }
}
