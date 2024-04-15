<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Public\Auth\LoginController;
use App\Http\Controllers\Api\Public\Accounts\RegisterController;

use App\Http\Controllers\Api\Auth\LogoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public endpoints
Route::middleware([])->group(function () {
    Route::post('/auth/register', [RegisterController::class, 'register'])->name('auth.register');
    Route::post('/auth/login', [LoginController::class, 'login'])->name('auth.login');
    
});

// Private Auth
Route::middleware([])->group(function () {
    Route::post('/auth/logout', [LogoutController::class, 'logout'])->name('auth.logout');
    
});
