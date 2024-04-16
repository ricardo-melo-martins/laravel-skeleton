<?php

use Illuminate\Support\Facades\Route;

// Public
use App\Http\Controllers\Api\Public\Auth\LoginController;
use App\Http\Controllers\Api\Public\Accounts\RegisterController;

// Private Auth
use App\Http\Controllers\Api\Auth\LogoutController;

// Private Apps
use App\Http\Controllers\Api\Tasks\TasksController;

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
Route::group(['middleware' => []], function () { 

    // Public endpoints
    Route::withoutMiddleware([])->group(function () {
        Route::post('/auth/register', [RegisterController::class, 'register'])->name('auth.register');
        Route::post('/auth/login', [LoginController::class, 'login'])->name('auth.login');
        
    });

    // Private Auth
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/auth/logout', [LogoutController::class, 'logout'])->name('auth.logout');
        // TODO: auth/me, pass recovery
    });

    // Private Apps
    Route::middleware(['auth:api'])->group(function () {
        Route::resource('tasks', TasksController::class);
    });

});