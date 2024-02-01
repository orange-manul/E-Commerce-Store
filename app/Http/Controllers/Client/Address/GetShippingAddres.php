<?php

namespace App\Http\Controllers\Client\Address;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class GetShippingAddres extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('user_template.shipping_address');
    }
}
