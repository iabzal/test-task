<?php

declare(strict_types = 1);

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\QuestionController;
use App\Http\Controllers\Client\SubcategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    if (auth()->guard('client')->check()) {
        return redirect()->route('client.request.list');
    }
    return Inertia::render('Client/Auth/Login');
})->name('client.page.login');

Route::get('/register', function () {
    if (auth()->guard('client')->check()) {
        return redirect()->route('client.request.list');
    }
    return Inertia::render('Client/Auth/Register');
})->name('client.register');

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard', App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');
        Route::get('/questions', [\App\Http\Controllers\Admin\QuestionController::class, 'list'])->name('admin.questions');
        Route::get('/question/{id}', [\App\Http\Controllers\Admin\QuestionController::class, 'findById'])->name('admin.question.view');
        Route::post('/question/{id}/answer', [\App\Http\Controllers\Admin\QuestionController::class, 'answer'])->name('admin.question.answer');

        Route::resource('/request', UserController::class, ['as' => 'admin']);
    });
});

Route::prefix('client')->group(function () {

    Route::post('/login', LoginController::class)->name('client.login');

    Route::post('/create', App\Http\Controllers\Client\RegisterController::class)->name('client.create');

    Route::group(['middleware' => 'client'], function () {
        Route::get('/request', [QuestionController::class, 'list'])->name('client.request.list');
        Route::post('/request', [QuestionController::class, 'create'])->name('client.request.create');
        Route::get('/get-subcategories/{category_id}', [SubcategoryController::class, 'findByCategoryId'])->name('subcategory.find');
    });
});
