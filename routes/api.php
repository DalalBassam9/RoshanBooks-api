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

Route::get('products', [\App\Http\Controllers\ProductController::class, "getProducts"]);
Route::get('products/{productId}', [\App\Http\Controllers\ProductController::class, "getProductDetails"]);
Route::post('/register', \App\Http\Controllers\RegisterController::class);
Route::post('/login', \App\Http\Controllers\LoginController::class);
Route::post('/logout', \App\Http\Controllers\LogoutController::class);
Route::middleware('auth:sanctum')->put('/my/update-Information', [\App\Http\Controllers\AccountUserController::class, 'updateUserInformation']);
Route::middleware('auth:sanctum')->post('/my/update-image', [\App\Http\Controllers\AccountUserController::class, 'updateUserImage']);
Route::middleware('auth:sanctum')->put('/my/update-password', [\App\Http\Controllers\AccountUserController::class, 'updatePassword']);

Route::get('/user', [\App\Http\Controllers\UserController::class,'getUser'])->middleware(['auth:sanctum']);
Route::get('/cart/items', [\App\Http\Controllers\CartController::class, 'getCartItems'])->middleware(['auth:sanctum']);
Route::middleware('auth:sanctum')->get('/cart', [\App\Http\Controllers\CartController::class,'getCartItems']);
Route::post('/cart',[\App\Http\Controllers\CartController::class, 'storeProductToCart'])->middleware(['auth:sanctum']);
Route::put('/cart', [\App\Http\Controllers\CartController::class, 'updateCart'])->middleware(['auth:sanctum']);
Route::delete('/cart/{cartId}', [\App\Http\Controllers\CartController::class, 'deleteCart'])->middleware(['auth:sanctum']);

Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'getWishlist']);
Route::get('/my/wishlist', [\App\Http\Controllers\WishlistController::class, 'getUserWishlist'])->middleware('auth:sanctum');
Route::post('/my/wishlist', [\App\Http\Controllers\WishlistController::class, 'addToWishlist'])->middleware('auth:sanctum');
Route::delete('/my/wishlist/{productId}', [\App\Http\Controllers\WishlistController::class, 'removeFromWishlist'])->middleware('auth:sanctum');

Route::get('my/ratings', [\App\Http\Controllers\RatingController::class, 'getUserRatings'])->middleware('auth:sanctum');;
Route::post('products/{product}/rating', [\App\Http\Controllers\RatingController::class, 'storeRatingOnProduct'])->middleware('auth:sanctum');
Route::get('/get-ratings/{product}', [\App\Http\Controllers\RatingController::class, 'getRatingsProduct']);
Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'checkoutOrder'])->middleware('auth:sanctum');
Route::get('/checkout/success', [\App\Http\Controllers\CheckoutController::class, 'checkoutSuccessOrder'])->middleware('auth:sanctum');


Route::get('categories/{category}', [\App\Http\Controllers\CategoryController::class,'getCategory']);
Route::get('get-products-category/{category}', [\App\Http\Controllers\CategoryController::class, 'getProductsbyCategory']);

    Route::get('/addresses', [\App\Http\Controllers\AddressController::class, 'getUserAddressess'])->middleware('auth:sanctum');
    Route::post('/addresses', [\App\Http\Controllers\AddressController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/addresses/{address}', [\App\Http\Controllers\AddressController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/addresses/{address}', [\App\Http\Controllers\AddressController::class, 'destroy'])->middleware('auth:sanctum');
    Route::put('/set-default-address/{address}', [\App\Http\Controllers\AddressController::class, 'setDefaultAddress'])->middleware('auth:sanctum');


Route::get('/my/orders', [\App\Http\Controllers\OrderController::class, 'getUserOrders'])->middleware('auth:sanctum');
Route::get('/my/orders/{order}', [\App\Http\Controllers\OrderController::class, 'findByIdUserOrder'])->middleware('auth:sanctum');