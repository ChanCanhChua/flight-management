<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function() {
    Route::group(['middleware' =>Authenticate::class ], function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
        Route::prefix('/airport')->group(function() {
            Route::get('/list', [\App\Http\Controllers\Admin\AirportsController::class, 'index']);
            Route::post('/create', [\App\Http\Controllers\Admin\AirportsController::class, 'create']);
            Route::post('/update', [\App\Http\Controllers\Admin\AirportsController::class, 'update']);
            Route::post('/delete', [\App\Http\Controllers\Admin\AirportsController::class, 'delete']);
        });
        Route::prefix('/flight')->group(function() {
            Route::get('/list', [\App\Http\Controllers\Admin\FlightsController::class, 'index']);
            Route::post('/create', [\App\Http\Controllers\Admin\FlightsController::class, 'create']);
            Route::post('/update', [\App\Http\Controllers\Admin\FlightsController::class, 'update']);
            Route::post('/delete', [\App\Http\Controllers\Admin\FlightsController::class, 'delete']);
        });
        Route::prefix('/ticket')->group(function() {
            Route::get('/list', [\App\Http\Controllers\Admin\TicketController::class, 'index']);
            Route::post('/create', [\App\Http\Controllers\Admin\TicketController::class, 'create']);
            Route::post('/update', [\App\Http\Controllers\Admin\TicketController::class, 'update']);
            Route::post('/delete', [\App\Http\Controllers\Admin\TicketController::class, 'delete']);
            Route::get('/create-view', [\App\Http\Controllers\Admin\TicketController::class, 'createView']);
            Route::get('/available-list', [\App\Http\Controllers\Admin\TicketController::class, 'index']);
        });
      
    });
    Route::get('/login', [AuthController::class,"loginView"])->name('loginAdmin');
    Route::post('/do-login', [AuthController::class,"doLogin"]);
    Route::post('/do-register', [AuthController::class,"doRegister"]);
    Route::get('/logout', [AuthController::class,"logout"])->name('admin.logout');
    Route::post('/register', [UserController::class,"addUser"]);

});
