<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyUsersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()
                ->route('admin.dashboard')
                ->withErrors([
                    'message' => 'Публичная часть сайта только для пользователей',
                ]);
        }

        return $next($request);
    }
}
