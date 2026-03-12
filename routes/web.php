<?php

use App\Http\Controllers\web\Admin\AdminDashboardController;
use App\Http\Controllers\web\Admin\AdminTaskController;
use App\Http\Controllers\web\Admin\AdminUserController;
use App\Http\Controllers\web\Auth\LoginController;
use App\Http\Controllers\web\Auth\RegisterController;
use App\Http\Controllers\web\TaskController;
use App\Http\Controllers\web\TaskResponseController;
use App\Http\Controllers\web\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('email/verify')->group(function () {
   Route::get('', function () {
       return view('auth.verify-email');})->middleware('auth')->name('verification.notice');

   Route::get('{id}/{hash}', function (EmailVerificationRequest $request) { //todo Разобраться полностью от а до я
       $request->fulfill();
       return redirect()->route('tasks.index');})->middleware(['auth', 'signed'])->name('verification.verify');

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
    Route::get('/edit', 'edit')->name('user.profile.edit');
    Route::patch('/', 'update')->name('user.profile.update');
    Route::post('/logout', 'logout')->name('user.logout');
    Route::get('/tasks/responses', 'myTasksResponses')->name('user.tasks.responses'); //todo "Устарело убрать или найти правильное применение"

    });



Route::middleware(['auth', 'verified', 'only.users'])->prefix('tasks')->controller(TaskController::class)->group(function () {
    Route::get('', 'index')->name('tasks.index');
    Route::post('', 'store')->name('tasks.store');
    Route::get('/create', 'create')->name('tasks.create');
    Route::get('/{task}', 'show')->name('tasks.show');
    Route::patch('{task}/report',  'reportCompletion')->name('tasks.report');
    Route::get('/{task}/edit', 'edit')->name('tasks.edit');
    Route::patch('/{task}', 'update')->name('tasks.update');
    Route::delete('/{task}', 'destroy')->name('tasks.destroy');
    Route::patch('/{task}/publish', 'publish')->name('tasks.publish');
    Route::patch('/{task}/cancelled', 'cancel')->name('tasks.cancel');
    Route::patch('/{task}/draft', 'draft')->name('tasks.draft');
    Route::patch('/{task}/confirm', 'confirmAndPay')->name('tasks.confirmAndPay');
});

Route::middleware(['auth', 'verified', 'only.users'])->controller(TaskResponseController::class)->group(function () {
    Route::get('/my-responses', 'index')->name('tasks.my.responses'); //todo (устарело вывод откликов на странице задачи удалить не нарушив целостность)
    Route::post('/{task}/response', 'store')->name('tasks.response.store');
    Route::patch('/{task}/response/{response}', 'chooseExecutor')->name('tasks.response.choose');
});


Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {

    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('/', 'index')->name('admin.dashboard');
    });

    Route::controller(AdminUserController::class)->group(function () {
        Route::get('/users', 'index')->name('admin.users');
        Route::get('/users/{user}/show',  'showUserInfo')->name('admin.user.show');
        Route::patch('/{user}/block', 'toggleBlock')->name('admin.user.block');
    });

    Route::controller(AdminTaskController::class)->group(function () {
        Route::get('/tasks', 'index')->name('admin.tasks');
        Route::get('/tasks/{task}/show',  'showTask')->name('admin.task.show');
        Route::patch('/tasks/{task}/status', 'changeStatus')->name('admin.tasks.status');
    });
});
