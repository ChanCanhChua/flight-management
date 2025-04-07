<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\Client\LoginController;

// Route chung không cần auth
Route::get('/', [HomeController::class, 'index'])->name('client.pages.home');

// Route đăng ký
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('client.register');
Route::post('/register', [RegisterController::class, 'register']);

// Route đăng nhập
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('client.login');
Route::post('/login', [LoginController::class, 'login']);

// Route đăng xuất
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Giữ nguyên như cũ

// Nhóm route cần auth
Route::middleware(['auth'])->group(function() {
    // Các route yêu cầu đăng nhập
    // Route::get('/profile', [ProfileController::class, 'index'])->name('client.profile');
});

// Nhóm route admin (nếu cần)
Route::prefix('admin')->group(function() {
    // Route admin ở đây
});