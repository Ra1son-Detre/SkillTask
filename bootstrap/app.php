<?php

use App\Http\Middleware\CheckingUserBlocking;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;

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
            'not.blocked' => CheckingUserBlocking::class,
        ]);
        $middleware->web(append: [
           CheckingUserBlocking::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
