<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::post('/home', [CartController::class, 'createSession']);
Route::post('/add_to_cart', [CartController::class, 'addToCart']);
