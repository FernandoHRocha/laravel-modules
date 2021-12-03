<?php

use Illuminate\Support\Facades\Route;
use Auth\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class,'login']);

Route::group(['middleware' => ['apiJWT']], function() {
    Route::post('/logout', [AuthController::class,'logout']);
});