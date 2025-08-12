<?php

use App\Models\Blog;
use App\Models\Comment;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;


// Public routes
Route::controller(ThemeController::class)->name('theme.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/category/{id}', 'category')->name('category');
    Route::get('/contact', 'contact')->name('contact');
    // Route::get('/singleblog', 'singleblog')->name('singleblog');
});
// Subscriber routes
Route::post('/subscribe/store', [SubscriberController::class, 'store'])->name('subscriber.store');
// Contact routes
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
// Blog routes
Route::get('/my-blogs', [BlogController::class, 'myBlogs'])->name('blogs.my-blogs');
Route::resource('blogs', BlogController::class);

// Comment routes
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');






// Auth routes
require __DIR__ . '/auth.php';

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
