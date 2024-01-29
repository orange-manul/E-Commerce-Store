<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __invoke()
    {
        $pending_orders = Order::where('status', 'pending')->latest()->get();
        return view('admin.pendingorders', compact('pending_orders'));

    }
}
