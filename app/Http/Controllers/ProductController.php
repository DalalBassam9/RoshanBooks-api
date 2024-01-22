<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Rating;
use App\Http\Resources\Website\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function getProducts(Request $request)
    {

        $query = Product::query();

        if ($request->has('category')) {
            $query->where('categoryId', $request->category);
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating':
                    $query->addSelect(['average_rating' => Rating::select(DB::raw('AVG(rating)'))
                    ->whereColumn('productId', 'products.productId')])
                    ->orderBy('average_rating', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                   
            }
        }
        if ($request->has('productStatus')) {
            if ($request->productStatus == 'stock') {
                $query->where('quantity', '>', 0);
            } elseif ($request->productStatus == 'out of stock') {
                $query->where('quantity', '=', 0);
            }
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(9);

        return ProductResource::collection($products);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function getProductDetails(string $id)
    {
        $product  = Product::findOrFail($id);
        return new ProductResource($product);
    }
}
