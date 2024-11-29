<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserProfileController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(BlogController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('blogs.index');
    Route::post('/blogs', 'store')->name('blogs.store');
    Route::get('/blogs/create', 'create')->name('blogs.create');
    Route::get('/blogs/{blog}', 'show')->name('blogs.show');
    Route::get('/blogs/{blog}/edit', 'edit')->name('blogs.edit');
    Route::put('/blogs/{blog}', 'update')->name('blogs.update');
    Route::delete('/blogs/{blog}', 'delete')->name('blogs.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/categories/{category}', [CategoryController::class, 'index'])->name('categories.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('blogs/{blog}/like', [LikeController::class, 'like'])->name('blogs.like');
    Route::post('blogs/{blog}/unlike', [LikeController::class, 'unlike'])->name('blogs.unlike');
});

Route::middleware('auth')->group(function () {
    Route::post('/blogs/{blog}/follow', [FollowController::class, 'follow'])->name('follow');
    Route::post('/blogs/{blog}/unfollow', [FollowController::class, 'unfollow'])->name('unfollow');
});

Route::get('/users/{id}', [UserProfileController::class, 'show'])->name('users.profile');

require __DIR__.'/auth.php';