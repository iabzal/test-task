<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    if (auth()->guard('client')->check()) {
        return redirect()->route('clientRequest');
    }
    return Inertia::render('Client/Auth/Login');
})->name('clientLogin');

