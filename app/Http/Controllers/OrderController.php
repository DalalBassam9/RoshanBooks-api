<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Http\Resources\Website\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getUserOrders()
    {
        $user = auth()->user()->userId;
        $orders = Order::where('userId', $user)->orderBy('created_at', 'desc')->get();
        return OrderResource::collection($orders);
    }

    public function findByIdUserOrder($id)
    {
       $order= Order::with('address')->where('userId', auth()->user()->userId)->with([
            'orderItems.product',
        ])->findOrFail($id);

        return new OrderResource($order);
    }

}
