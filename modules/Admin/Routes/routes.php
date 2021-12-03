<?php

use Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['apiJWT']], function() {
    Route::get('/home', [AdminController::class,'index']);
});

