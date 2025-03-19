<?php
use App\Http\Controllers\Client\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('Home', [\App\Http\Controllers\Client\HomeController::class, 'index']);




Route::get('/login', [LoginController::class, 'getLogin'])->name('login');


Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');


Route::prefix('/booking')->group(function() {
    Route::get('index', [\App\Http\Controllers\Client\BookingController::class, 'index'])->name('booking.index');
    Route::post('store', [\App\Http\Controllers\Client\BookingController::class, 'store'])->name('booking.store');

});

Route::get('passenger', function () {
    return view('client/pages/passenger');
});






    