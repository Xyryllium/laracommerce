<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user', [UserController::class, 'update']);
    Route::get('/user/{id}', [UserController::class, 'get']);
});
