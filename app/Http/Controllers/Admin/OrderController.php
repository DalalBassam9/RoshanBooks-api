<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrders()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(5);
        return OrderResource::collection($orders);
    }

    public function updateStatusOrder($orderId, Request $request)
    {
        $order = Order::findOrFail($orderId);
        $order->update([
            'status' => $request->status,
       
        ]);

        return new OrderResource($order);
    }

}
