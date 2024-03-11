<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Api\Http\Controllers\ApiController;



Route::group(['prefix' => 'auth'], function () {

    Route::post('/login', [ApiController::class, 'login'])->name('login');
    Route::post('/logout', [ApiController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'user'], function () {

    Route::get('/users', [ApiController::class, 'userIndex']);
    Route::get('/employees', [ApiController::class, 'employeeIndex']);
});
