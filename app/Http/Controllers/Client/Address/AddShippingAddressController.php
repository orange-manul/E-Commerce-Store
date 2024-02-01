<?php

namespace App\Http\Controllers\Client\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ShippinAddressStoreRequest;
use App\Models\Cart;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddShippingAddressController extends Controller
{
    public function __invoke(ShippinAddressStoreRequest $request)
    {
        ShippingInfo::insert([
        'user_id' => Auth::id(),
        'phone_number' => $request->phone_number,
        'city_name' => $request->city_name,
        'postal_code' => $request->postal_code,
    ]);

        return redirect()->route('checkout');

    }
}
