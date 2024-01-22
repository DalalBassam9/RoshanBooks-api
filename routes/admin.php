<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('cities', \App\Http\Controllers\Admin\CityController::class);
Route::apiResource('categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::get('/cities-lookups', [\App\Http\Controllers\Admin\CityController::class, 'getCitiesLookups']);
Route::get('/categories-lookups', [\App\Http\Controllers\Admin\CategoryController::class, 'getCategoriesLookups']);
Route::apiResource('products', \App\Http\Controllers\Admin\ProductController::class);
Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'getOrders']);
Route::put('/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatusOrder']);
Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index']);