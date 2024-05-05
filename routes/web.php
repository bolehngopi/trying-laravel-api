<?php

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

if (App::environment('local')) {
    Route::get('/playground', function () {
        $user = User::factory()->make();
        Mail::to($user)
            ->send(new WelcomeEmail($user));
        return null;
    });
}
