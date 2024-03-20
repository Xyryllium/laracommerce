<?php

use App\Http\Controllers\SanctumController;
use Illuminate\Support\Facades\Route;

Route::post('/sanctum/token', [SanctumController::class, 'issueToken']);