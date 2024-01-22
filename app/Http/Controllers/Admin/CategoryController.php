<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Website\CategoryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category  = Category::findOrFail($id);
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category  = Category::findOrFail($id);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest  $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category  = Category::findOrFail($id);
        $category->delete();
        return response()->json(null, 204);
    }
    /**
     * Display a listing of the resource.
     */
    public function getCategoriesLookups()
    {
        $categories = Category::select('categoryId','name')->get();
         return response()->json(['categories' => $categories]);
      //return CategoryResource::collection($categories);
    }


}
