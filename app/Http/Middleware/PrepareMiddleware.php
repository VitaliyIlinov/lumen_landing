<?php

namespace App\Http\Middleware;

use Closure;

class PrepareMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!env('TEST_SHOW_ALL')) {
            return redirect('/');
        }

        return $next($request);
    }
}
