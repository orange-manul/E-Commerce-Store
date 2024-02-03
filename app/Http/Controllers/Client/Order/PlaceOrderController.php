<?php

namespace App\Http\Controllers\Client\Order;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class   PlaceOrderController extends Controller
{
    public function __invoke()
    {
        $userId = Auth::id();
        $shipping_address = ShippingInfo::where('user_id', $userId)->first();
        $cart_items = Cart::where('user_id', $userId)->get();

        foreach ($cart_items as $item) {
            Order::insert([
                'userId' => $userId,
                'status' => 'pending', // Replace with the appropriate initial status
                'shipping_phoneNumber' => $shipping_address->phone_number,
                'shipping_city' => $shipping_address->city_name,
                'shipping_postalCode' => $shipping_address->postal_code,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->price,
            ]);

            $id = $item->id;
            Cart::findOrFail($id)->delete();
        }

         return redirect()->route('pending_orders')->with('message', 'Your order has been place successfully');

    }
}
