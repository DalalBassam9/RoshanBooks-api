<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Resources\Website\CartResource;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCartItems()
    {
        $cartItems = Cart::where('userId', auth()->user()->userId)->orderBy('created_at', 'desc')->get();
        return CartResource::collection($cartItems);
    }
    public function storeProductToCart(CartRequest $request)
    {
        $user = auth()->user()->userId;
        if ($user) {
            $cartItem = Cart::where(['userId' => $user, 'productId' => $request->productId])->first();

            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->update();
            } else {

                $cartItem =  Cart::create([
                    'quantity' =>  $request->quantity,
                    'userId' => auth()->user()->userId,
                    'productId' => $request->productId,
                ]);
            }
        }

        return new  CartResource($cartItem);
    }

    public function updateCart(CartRequest $request)
    {
        $user = auth()->user()->userId;
        if ($user) {
            $cart =  Cart::where(['userId' => $user, 'productId' => $request->productId])->first();
            $cart->update(['quantity' => $request->quantity]);
        }
        return new  CartResource($cart);

    }

    public function deleteCart($cartId)
    {
        $cartItem = Cart::where(['userId' => auth()->user()->userId, 'cartId' => $cartId])->firstorfail();
        if ($cartItem) {
            $cartItem->delete();
             return new  CartResource($cartItem);
        }
    }
}
