<?php

use App\Http\Middleware\CheckingUserBlockingMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\OnlyUsersMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectUsersTo(function(){
            return route('tasks.index');
        });
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'not.blocked' => CheckingUserBlockingMiddleware::class,
            'only.users' => OnlyUsersMiddleware::class,

        ]);
        $middleware->web(append: [
           CheckingUserBlockingMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
