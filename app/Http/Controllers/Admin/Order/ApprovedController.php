<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Admin\BaseController;

class ApprovedController extends BaseController
{
    public function __invoke($orderId)
    {
        $this->orderService->approvedOrders($orderId);

        return redirect()->route('pending.order');
    }

}
