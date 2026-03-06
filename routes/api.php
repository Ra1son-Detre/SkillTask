<?php


use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\RegisterController;
use App\Http\Controllers\Api\v1\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return ['message' => 'API работает'];
});

Route::prefix('v1')->group(function () {

    Route::post('/auth/register', [RegisterController::class, 'register']);
    Route::post('/auth/login', [LoginController::class, 'login']);

    // Защищённые
    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/tasks', [TaskController::class, 'index']);
        Route::post('/tasks', [TaskController::class, 'store']);
        Route::patch('/tasks/{task}', [TaskController::class, 'update']);
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
        Route::get('/tasks/{task}', [TaskController::class, 'show']);
    });
});

