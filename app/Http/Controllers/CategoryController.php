<?php

namespace App\Http\Controllers;
use App\Http\Resources\Website\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Http\Resources\Website\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function getCategory(string $id)
    {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }

    public function getProductsbyCategory($id,Request $request)
    {
        $category = Category::findOrFail($id);

        $query = Product::where('categoryId', $id);

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

        $products = $query->orderBy('created_at', 'desc')->paginate(3);

        return ProductResource::collection($products);

    }
}
