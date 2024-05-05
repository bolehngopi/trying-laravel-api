<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'auth'
])
    // ->prefix('post')
    ->name('comments.')
    ->group(function () {

        Route::get('/comments', [CommentController::class, 'index'])->name('index');

        Route::get('/comments/{user}', [CommentController::class, 'show'])->name('show');

        Route::post('/comments', [CommentController::class, 'store'])->name('store');

        Route::put('/comments/{user}', [CommentController::class, 'update'])->name('update');

        Route::delete('/comments/{user}', [CommentController::class, 'delete'])->name('delete');
    });
