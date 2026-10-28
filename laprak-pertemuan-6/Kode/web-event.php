<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\EventController;

Route::get('/event', [EventController::class, 'index']);
