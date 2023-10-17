<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\LoginController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    if (auth()->guard('client')->check()) {
        return redirect()->route('client.request');
    }
    return Inertia::render('Client/Auth/Login');
})->name('client.page.login');

Route::post('/clients/login', LoginController::class)->name('client.login');

Route::get('/register', function () {
    if (auth()->guard('client')->check()) {
        return redirect()->route('client.request');
    }
    return Inertia::render('Client/Auth/Register');
})->name('client.register');

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard', App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');

        Route::resource('/request', UserController::class, ['as' => 'admin']);
    });
});

Route::prefix('client')->group(function () {

    Route::post('/create', App\Http\Controllers\Client\RegisterController::class)->name('client.create');

    Route::group(['middleware' => 'client'], function () {
        Route::get('/request', ClientController::class)->name('client.request');
    });
});
