<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'Auth'], function () {
    Route::group(['middleware' => ['guest']], function () {
        Route::controller('LoginController')
            ->prefix('login')
            ->group(function () {
                Route::get('/', 'showLoginForm')->name('login');
                Route::post('/', 'login')->name('login.post');
            });

        Route::controller('ForgotPasswordController')
            ->prefix('forgot-password')
            ->group(function () {
                Route::get('/', 'showLinkRequestForm')->name('forgot-password');
                Route::post('/', 'sendResetLinkEmail');
            });
    });
});

Route::get('/', 'DashboardController')->name('index');
