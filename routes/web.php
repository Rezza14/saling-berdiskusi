<?php

use App\Enums\RoleEnum;
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

        Route::controller('ResetPasswordController')
            ->prefix('reset-password')
            ->group(function () {
                Route::get('/{token}', 'showResetForm')->name('password.reset');
                Route::post('/{token}', 'reset');
            });
    });
});

Route::get('/', 'DashboardController')->name('index');

Route::group(['middleware' => ['auth', 'role:' . implode('|', [RoleEnum::ADMINISTRATOR->value, RoleEnum::TEACHER->value, RoleEnum::STUDENT->value])]], function () {

    Route::controller('ProfileController')
            ->as('profile.')
            ->prefix('profile')
            ->group(function () {
                Route::put('update/avatar', 'updateAvatar')->name('updateAvatar');
                Route::put('update/password', 'updatePassword')->name('updatePassword');
            });

    Route::resource('profile', 'ProfileController');

    Route::resource('user', 'UserController')->middleware(['role:' . implode('|', [RoleEnum::ADMINISTRATOR->value])]);

    Route::resource('discussions', 'DiscussionController');

    Route::resource('comments', 'CommentController')->only(['store', 'edit', 'update', 'delete']);
});
