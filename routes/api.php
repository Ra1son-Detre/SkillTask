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

    Route::post('/auth/register', [RegisterController::class, 'register']);
    Route::post('/auth/login', [LoginController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::middleware('only.users')->group(function () {
            Route::prefix('profile')->controller(ProfileController::class)->group(function () {
                Route::get('/', 'show');
                Route::patch('/', 'update');
                Route::post('/logout', 'logout');
            });

            Route::controller(TaskController::class)->group(function () {
                Route::get('/tasks','index');
                Route::post('/tasks','store');
                Route::get('/tasks/{task}','show');
                Route::delete('/tasks/{task}','destroy');
                Route::patch('/tasks/{task}','update');

                Route::patch('/tasks/{task}/publish','publish');
                Route::patch('/tasks/{task}/draft','draft');
                Route::patch('/tasks/{task}/cancel','cancel');
                Route::patch('/tasks/{task}/execute','completeTask');
                Route::patch('/tasks/{task}/confirm','confirmAndPay');
            });

            Route::controller(TaskResponseController::class)->group(function () {
                Route::post('/tasks/{task}/responses','store');
                Route::patch('/tasks/{task}/responses/{response}','chooseExecutor');
            });
        });


        Route::prefix('admin')->middleware('admin')->group(function () {

            Route::controller(AdminUserController::class)->group(function () {
                Route::get('/users','index');
                Route::get('/users/{user}/show','showUserInfo');
                Route::patch('/users/{user}/toggle', 'toggleBlock');
            });

            Route::controller(AdminTaskController::class)->group(function () {
                Route::get('/tasks', 'index');
                Route::get('/tasks/{task}', 'show');
                Route::patch('/tasks/{task}/edit/status', 'changeStatus');
            });

            Route::get('/dashboard',[AdminDashboardController::class,'globalStats']);
        });
    });
});

