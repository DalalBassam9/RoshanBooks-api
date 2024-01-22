<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;
use App\Http\Requests\RatingRequest;
use App\Http\Resources\Website\RatingResource;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function getRatingsProduct($productId)
    {
        $product  = Product::findOrFail($productId);
        $ratings = Rating::with('user')->where('productId', $productId)->orderBy('created_at', 'desc')->get();
        return RatingResource::collection($ratings);
    }

    public function getUserRatings()
    {
        $ratings = Rating::where('userId', auth()->user()->userId)->orderBy('created_at', 'desc')->get();
        return RatingResource::collection($ratings);
    }

    public function storeRatingOnProduct(RatingRequest $request,$product)
    {
        $product  = Product::findOrFail($product);


        $rating = Rating::create([
            'productId' => $product->productId,
            'userId'   => auth()->user()->userId,
            'rating'   => $request->rating,
            'review'    => $request->review,
        ]);

        return new RatingResource($rating);
    }
}
