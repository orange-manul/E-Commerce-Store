<?php

namespace App\Http\Controllers\Client\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendingOrderController extends Controller
{

    public function __invoke(Request $request)
    {
        $userId = Auth::id();
        $pending_orders = Order::where('userId', $userId)->where('status', 'pending')->latest()->get();
        return view('user_template.pending_orders', compact('pending_orders'));

    }
}
