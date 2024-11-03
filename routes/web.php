<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () { return view('welcome'); });
Route::get('/', [PostController::class, 'index']);
Route::get('/users/create', [PostController::class, 'create']);
Route::get('/blogs/{blog}', [PostController::class, 'show']);

Route::post('/blogs', [PostController::class, 'store']);