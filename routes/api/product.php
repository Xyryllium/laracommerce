<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/product/category', [ProductController::class, 'updateCategory']);
    Route::delete('/product/category/{id}', [ProductController::class, 'softDeleteCategory']);
    Route::post('/product/inventory', [ProductController::class, 'updateInventory']);
});

Route::get('/product/category/{id}', [ProductController::class, 'getCategory']);
Route::get('/product/{id}', [ProductController::class, 'getProductById']);
Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/product', [ProductController::class, 'createProduct']);
