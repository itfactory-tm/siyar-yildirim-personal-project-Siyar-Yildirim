<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActiveUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->active) {
            return $next($request);
        }
        // logout the user from the web guard
        auth('web')->logout();
        // abort the request with a message
        return abort(403, 'Your account is not active. Please contact the administrator.');
    }
}
