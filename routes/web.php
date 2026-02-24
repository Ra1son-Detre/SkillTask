<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskResponseController;
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

    Route::prefix('login')->controller(LoginController::class)->group(function () {
        Route::get('', 'show')->name('login');
        Route::post('', 'store')->name('login.try');
    });

    Route::prefix('register')->controller(RegisterController::class)->group(function () {
        Route::get('form', 'create')->name('register.create');
        Route::post('form', 'store')->name('register.store');
    });

});


Route::middleware(['auth', 'verified'])->prefix('profile')->controller(UserController::class)->group(function () {

        Route::get('/', 'show')->name('user.profile');
        Route::post('/logout', 'logout')->name('user.logout');

        Route::get('/tasks/responses', 'myTasksResponses')->name('user.tasks.responses');
    });



Route::middleware(['auth', 'verified'])->prefix('/tasks')->controller(TaskController::class)->group(function () {
    Route::get('', 'index')->name('tasks.index');
    Route::post('', 'store')->name('tasks.store');
    Route::get('/create', 'create')->name('tasks.create');
    Route::get('/{task}', 'show')->name('tasks.show');
    Route::get('/{task}/edit', 'edit')->name('tasks.edit');
    Route::patch('/{task}', 'update')->name('tasks.update');
    Route::delete('/{task}', 'destroy')->name('tasks.destroy');
    Route::patch('/{task}/publish', 'publish')->name('tasks.publish');
    Route::patch('/{task}/draft', 'draft')->name('tasks.draft');


});

Route::middleware(['auth', 'verified'])->prefix('/tasks')->controller(TaskResponseController::class)->group(function () {
    Route::post('/{task}/response', 'store')->name('tasks.response.store');
    Route::patch('/{task}/response/{response}', 'chooseExecutor')->name('tasks.response.choose');



});
