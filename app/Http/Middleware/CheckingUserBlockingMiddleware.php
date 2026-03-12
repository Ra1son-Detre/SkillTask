<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckingUserBlockingMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->is_blocked){

            auth()->logout();

            return redirect()->route('login')
                ->withErrors(['Ваш аккаунт заблокировали, обратитесь в службу поддержки']);
        }

        return $next($request);
    }
}
