<?php

namespace App\Http\Controllers\Client\Order;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\Auth;

class PendingOrderController extends BaseController
{

    public function __invoke()
    {
        $userId = Auth::id();
        $pending_orders = $this->orderService->getPendingOrders();
        return view('user_template.pending_orders', compact('pending_orders'));
    }
}
