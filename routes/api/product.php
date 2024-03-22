<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/product/category', [ProductController::class, 'updateCategory']);
    Route::delete('/product/category/{id}', [ProductController::class, 'softDeleteCategory']);
});

Route::get('/product/category/{id}', [ProductController::class, 'getCategory']);
