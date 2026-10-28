<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BukuController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about', [
        'name' => 'Reyhan',
        'email' => 'reyy@gmail.com'
    ]
    );
});

Route::get('/buku', [BukuController::class, 'index'])
    ->name('buku.index');

Route::get('/posts', [PostController::class, 'index']);

