<?php

use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\RegisterController;
use App\Http\Controllers\Api\v1\TaskController;
use App\Http\Controllers\Api\v1\TaskResponseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Admin\AdminUserController;
use App\Http\Controllers\Api\v1\Admin\AdminDashboardController;
use App\Http\Controllers\Api\v1\Admin\AdminTaskController;
use App\Http\Controllers\Api\v1\ProfileController;

Route::prefix('v1')->group(function () {

    Route::post('auth/register', [RegisterController::class, 'register']);
    Route::post('auth/login', [LoginController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::middleware('only.users')->group(function () {

            Route::prefix('profile')->controller(ProfileController::class)->group(function () {
                Route::get('/', 'show');
                Route::post('/', 'update');
                Route::patch('deposit', 'deposit');
                Route::post('logout', 'logout');
            });

            Route::prefix('tasks')->controller(TaskController::class)->group(function () {
                Route::get('', 'index');
                Route::post('', 'store');
                Route::get('{task}', 'show');
                Route::delete('{task}', 'destroy');
                Route::patch('{task}', 'update');

                Route::patch('{task}/publish', 'publish');
                Route::patch('{task}/draft', 'draft');
                Route::patch('{task}/cancel', 'cancel');
                Route::patch('{task}/execute', 'completeTask');
                Route::patch('{task}/confirm', 'confirmAndPay');
            });

            Route::prefix('tasks/{task}/responses')->controller(TaskResponseController::class)->group(function () {
                Route::post('', 'respond');
                Route::patch('{response}', 'chooseExecutor');
            });
        });

        Route::prefix('admin')->middleware('admin')->group(function () {

            Route::prefix('users')->controller(AdminUserController::class)->group(function () {
                Route::get('', 'index');
                Route::get('{user}/show', 'showUserInfo');
                Route::patch('{user}/toggle', 'toggleBlock');
            });

            Route::prefix('tasks')->controller(AdminTaskController::class)->group(function () {
                Route::get('', 'index');
                Route::get('{task}', 'show');
                Route::patch('{task}/status', 'changeStatus');
            });

            Route::get('dashboard', [AdminDashboardController::class, 'globalStats']);
        });
    });
});

