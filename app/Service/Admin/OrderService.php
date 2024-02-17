<?php

namespace App\Service\Admin;

use App\Models\Order;

class OrderService
{
    public function getPendingOrders()
    {
        return Order::where('status', 'pending')->latest()->get();
    }

    public function approvedOrders($orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->status = 'successfully';
        $order->save();
    }
}
