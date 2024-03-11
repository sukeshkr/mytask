<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\Auth\LoginController;
use Modules\Admin\Http\Controllers\CompanyController;
use Modules\Admin\Http\Controllers\Dashboard\DashboardController;
use Modules\Admin\Http\Controllers\EmployeeController;
use Modules\Admin\Http\Controllers\User\ForgotController;

Route::get('/reset-password/{token}', [ForgotController::class, 'resetForgot'])->name('password.reset')->middleware('guest');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    //Login
    Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
    Route::post('/login', [LoginController::class, 'loginUser'])->name('logpost')->middleware('guest');
    //forgot
    Route::get('/forgot-password', [ForgotController::class, 'index'])->name('password.request')->middleware('guest');
    Route::post('/forgot-password', [ForgotController::class, 'postForgot'])->name('password.email')->middleware('guest');
    Route::post('/reset-password', [ForgotController::class, 'postResetForgot'])->name('password.update')->middleware('guest');
    //admin auth
    Route::group(['middleware' => 'admin_auth:web'], function () {
        //dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('companies', CompanyController::class)->except('show');
        Route::get('company/list', [CompanyController::class, 'list'])->name('company.list');

        Route::resource('employees', EmployeeController::class)->except('show');
        Route::get('employee/list', [EmployeeController::class, 'list'])->name('employee.list');


        //logout
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        //invalid routes
        Route::fallback(function () {
            return view('admin::misc-error');
        });
    });
});
Route::fallback(function () {
    return view('admin::misc-error');
});
