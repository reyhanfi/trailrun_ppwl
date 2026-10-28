<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
})->name('home');

Route::middleware('guest')
    ->controller(LoginRegisterController::class)
    ->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/store', 'store')->name('store');

        Route::get('/login', 'login')->name('login');
        Route::post('/authenticate', 'authenticate')->name('authenticate');
    });

Route::middleware('auth')->group(function () {
    Route::controller(LoginRegisterController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::controller(EventController::class)->group(function () {
        Route::get('/event/search', 'search')->name('event.search');
        Route::get('/event', 'index')->name('event.index');
        Route::get('/event/create', 'create')->name('event.create');
        Route::post('/event', 'store')->name('event.store');
        Route::get('/event/{event}/edit', 'edit')->name('event.edit');
        Route::put('/event/{event}', 'update')->name('event.update');
        Route::delete('/event/{event}', 'destroy')->name('event.destroy');
    });
});