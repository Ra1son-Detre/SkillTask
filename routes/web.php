<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('email/verify')->group(function () {
   Route::get('', function () {
       return view('auth.verify-email');
   })->middleware('auth')->name('verification.notice');

   Route::get('{id}/{hash}', function (EmailVerificationRequest $request) {
       $request->fulfill();
       return redirect()->route('tasks.index');
   })->middleware(['auth', 'signed'])->name('verification.verify');

});
Route::middleware('guest')->group(function () {
    Route::prefix('/login')->group(function () {
        Route::get('', [LoginController::class, 'show'])->name('login.show');
        Route::post('', [LoginController::class, 'store'])->name('login.try');
    });
});


Route::prefix('/register')->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/form', 'create')->name('register.create');
        Route::post('/form', 'store')->name('register.store');
    });
});


Route::middleware(['auth', 'verified'])->prefix('tasks/')->controller(UserController::class)->group(function () {
        Route::get('profile', 'show')->name('user.profile');
        Route::post('profile', 'logout')->name('user.logout');
    });



Route::middleware(['auth', 'verified'])->prefix('/tasks')->controller(TaskController::class)->group(function () {
    Route::get('/index', 'index')->name('tasks.index');
    Route::get('/create', 'create')->name('tasks.create');
    Route::post('', 'store')->name('tasks.store');

});
