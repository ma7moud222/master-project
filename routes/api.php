<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

// تسجيل الدخول


// مسارات الـ posts
Route::apiResource('posts', PostController::class);
// يمكنك إضافة المزيد من المسارات الخاصة بالـ API هنا
// مثال:
// Route::get('user', [UserController::class, 'show']);

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware(['auth:api'])->group(function () {
        Route::get('me', [AuthController::class, 'me'])->name('me');
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
});
