<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Cart\StoreCartRequest;
use App\Http\Requests\Client\ShippinAddressStoreRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function categoryPage($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('product_category_id', $id)->latest()->get();

        return view('user_template.category', compact('category', 'products'));
    }

    public function singleProduct($id)
    {
        $product = Product::findOrFail($id);
        $subcategory_id = Product::where('id', $id)->value('product_subcategory_id');
        $related_products = Product::where('product_subcategory_id', $subcategory_id)->latest()->get();
        return view('user_template.product', compact('product', 'related_products'));
    }

//    public function addToCart()
//    {
//        $userId = Auth::id();
//        $cart_items = Cart::where('user_id', $userId)->get();
//        return view('user_template.add_to_cart', compact('cart_items'));
//    }

    public function addProductToCart(StoreCartRequest $request)
    {
        $product_price = $request->price;
        $quantity = $request->quantity;
        $price = $product_price * $quantity;

        Cart::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'price' => $price
        ]);

        return redirect()->route('add_to_cart')->with('message', 'Your item added to cart successfully');
    }

    public function removeCartItem($id)
    {
        Cart::findOrFail($id)->delete();

        return redirect()->route('add_to_cart')->with('message', 'Your item remove from cart successfully');
    }

    public function getShippingAddress()
    {
        return view('user_template.shipping_address');
    }

    public function addShippingAddress(ShippinAddressStoreRequest $request)
    {
        ShippingInfo::insert([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'city_name' => $request->city_name,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()->route('checkout');

    }


//    public function checkout()
//    {
//        $userId = Auth::id();
//        $cart_items = Cart::where('user_id', $userId)->get();
//        $shipping_address = ShippingInfo::where('user_id', $userId)->first();
//        return view('user_template.checkout', compact('shipping_address','cart_items'));
//    }

//    public function placeOrder(){
//        $userId = Auth::id();
//        $shipping_address = ShippingInfo::where('user_id', $userId)->first();
//        $cart_items = Cart::where('user_id', $userId)->get();
//
//        foreach($cart_items as $item){
//            Order::insert([
//                'userId' => $userId,
//                'shipping_phoneNumber' => $shipping_address->phone_number,
//                'shipping_city' => $shipping_address->city_name,
//                'shipping_postalCode' => $shipping_address->postal_code,
//                'product_id' => $item->product_id,
//                'quantity' => $item->quantity,
//                'total_price' => $item->price,
//            ]);
//
//            $id = $item->id;
//            Cart::findOrFail($id)->delete();
//        }
//
//        return redirect()->route('pending_orders')->with('message', 'Your order has been place successfully');
//    }
//
//    public function userProfile()
//    {
//        return view('user_template.user_profile');
//    }
//
//    public function pendingOrders()
//    {
//        $userId = Auth::id();
//        $pending_orders = Order::where('userId', $userId)->where('status', 'pending')->latest()->get();
//        return view('user_template.pending_orders', compact('pending_orders'));
//    }
//
//    public function history()
//    {
//        return view('user_template.history');
//    }

    public function newRelease()
    {
        return view('user_template.new_release');
    }

    public function todaysDeal()
    {
        return view('user_template.todays_deal');
    }

    public function customService()
    {
        return view('user_template.custom_service');
    }

}
