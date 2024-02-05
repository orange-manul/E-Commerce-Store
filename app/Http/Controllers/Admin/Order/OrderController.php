<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Admin\BaseController;
use App\Service\Admin\OrderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class OrderController extends BaseController
{

    public function __invoke(OrderService $service): Factory|View|Application
    {
        $pendingOrders = $this->orderService->getPendingOrders();

        return view('admin.pendingorders', compact('pendingOrders'));

    }
}
