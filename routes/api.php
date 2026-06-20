<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CartitemsController;
use App\Http\Controllers\Api\CartsController;
use App\Http\Controllers\Api\OrderItemsController;
use App\Http\Controllers\Api\OrdersController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user', [UserController::class, 'show']);
    Route::put('/update', [UserController::class, 'update']);
    Route::delete('/delete', [UserController::class, 'delete']);
    Route::post('/products', [ProductsController::class, 'store']);
    Route::put('/products/{id}', [ProductsController::class, 'update']);
    Route::delete('/products/{id}', [ProductsController::class, 'destroy']);
    Route::post('/categories', [CategoriesController::class, 'store']);
    Route::put('/categories/{id}', [CategoriesController::class, 'update']);
    Route::delete('/categories/{id}', [CategoriesController::class, 'destroy']);
    Route::post('/cartitems', [CartitemsController::class, 'store']);
    Route::put('/cartitems/{id}', [CartitemsController::class, 'update']);
    Route::delete('/cartitems/{id}', [CartitemsController::class, 'destroy']);
    Route::post('/carts', [CartsController::class, 'store']);
    Route::put('/carts/{id}', [CartsController::class, 'update']);
    Route::delete('/carts/{id}', [CartsController::class, 'destroy']);
    Route::post('/orders', [OrdersController::class, 'store']);
    Route::put('/orders/{id}', [OrdersController::class, 'update']);
    Route::delete('/orders/{id}', [OrdersController::class, 'destroy']);
    Route::post('/orderitems', [OrderItemsController::class, 'store']);
    Route::put('/orderitems/{id}', [OrderItemsController::class, 'update']);
    Route::delete('/orderitems/{id}', [OrderItemsController::class, 'destroy']);
});

Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/{id}', [ProductsController::class, 'show']);
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/categories/{id}', [CategoriesController::class, 'show']);
Route::get('/cartitems', [CartitemsController::class, 'index']);
Route::get('/cartitems/{id}', [CartitemsController::class, 'show']);
Route::get('/carts', [CartsController::class, 'index']);
Route::get('/carts/{id}', [CartsController::class, 'show']);
Route::get('/orders', [OrdersController::class, 'index']);
Route::get('/orders/{id}', [OrdersController::class, 'show']);
Route::get('/orderitems', [OrderItemsController::class, 'index']);
Route::get('/orderitems/{id}', [OrderItemsController::class, 'show']);