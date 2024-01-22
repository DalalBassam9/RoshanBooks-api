<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Resources\Admin\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return ProductResource::collection($products);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store("images",'public');

    
        }
        $product =  Product::create([
            'name' => $request->name,
            'categoryId' => $request->categoryId,
            'image' =>  $image,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        $product  = Product::findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $producId)
    {
      
        $product  = Product::findOrFail($producId);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store("images", 'public');
        } else {
            $image = $product->image;
        } 

        $product->update([
            'name' => $request->name,
            'categoryId' => $request->categoryId,
            'image' =>  $image,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return new ProductResource($product);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product  = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
