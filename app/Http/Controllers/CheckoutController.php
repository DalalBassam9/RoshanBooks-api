<?php

namespace App\Http\Controllers;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Cart;
use App\Http\Resources\Website\OrderResource;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function checkoutOrder(Request $request){


      $order= Order::create([
            'userId' => auth()->user()->userId,
            'status' => 'pending',
            'totalPrice' => $request->totalPrice,
            'addressId' => $request->addressId,
            
        ]);

        foreach ($request->items as $item) {
            $orderItem = new OrderItem;
            $orderItem->orderId = $order->orderId;
            $orderItem->productId = $item['productId'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $request->price;
            $orderItem->save();
        }

        Cart::where('userId' , auth()->user()->userId)->delete();
        return new OrderResource($order);

    }

    public function checkoutSuccessOrder(){

        $order = Order::with('address','address.city:cityId,name','orderItems.product')->where('userId', auth()->user()->userId)->where('status', 'pending')->orderBy('created_at', 'desc')->first();
        return new OrderResource($order);

    }


}

