<?php

// Route::apiResource('users', UserController::class);

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'auth'
])
    ->prefix('auth')
    ->name('user.')
    ->group(function () {

        Route::get('/users', [UserController::class, 'index'])
            ->name('index');

        Route::get('/users/{user}', [UserController::class, 'show'])
            ->name('show')
            // ->where('user', '[0-9]+')
        ;

        Route::post('/users', [UserController::class, 'store'])
            ->name('store');

        Route::put('/users/{user}', [UserController::class, 'update'])
            ->name('update');

        Route::delete('/users/{user}', [UserController::class, 'delete'])
            ->name('delete');
    });
