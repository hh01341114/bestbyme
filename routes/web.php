<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () { return view('welcome'); });

Route::get('/', function () {
    return view('users.user');
});

Route::get('/users', [PostController::class, 'index']); 