<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Wishlist;
use Auth;
use App\Http\Resources\Website\ProductResource;
use App\Http\Resources\Website\WishlistResource;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Get User Wishlist
     * @return JsonResponse
     */

     public function getWishlist()
    {

        $wishlistItems = Wishlist::all();
        return ProductResource::collection($wishlistItems);

    }

    public function getUserWishlist()
    {

        $user = auth()->user();
        $wishlistItems = $user->wishlists()->get();
        return ProductResource::collection($wishlistItems);

    }
    /**
     * remove From Wishlist .
     * @param int|string $productId
     */
    public function removeFromWishlist($productId)
    {
        $user = auth()->user();
        $product = Product::findOrFail($productId);
        $user->wishlists()->detach($product);
        return new ProductResource($product);
    }
    /**
     *  add To Wishlist .
     * @param int|string $productId
     * @return JsonResponse
     */
    public function addToWishlist(Request $request)
    {
        $user = auth()->user();
        $product = Product::findOrFail($request->productId);
         $user->wishlists()->attach($product->productId);
         return new ProductResource($product);
    }
}
