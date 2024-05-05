<?php

use App\Helpers\Routes\RouteHelper;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->group(function () {
        RouteHelper::includeRouteFiles(__DIR__.'/api/v1/');
        
        // require __DIR__ . '/api/v1/users.php';
        // require __DIR__ . '/api/v1/posts.php';
        // require __DIR__ . '/api/v1/comments.php';
    });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
