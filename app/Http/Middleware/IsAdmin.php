<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->account_type === 'admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
