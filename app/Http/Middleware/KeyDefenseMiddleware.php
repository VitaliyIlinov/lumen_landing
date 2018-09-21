<?php

namespace App\Http\Middleware;

use App\Exceptions\LogException;
use Closure;

class KeyDefenseMiddleware
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws LogException
     */
    public function handle($request, Closure $next)
    {
        if (is_null(env('ACCESS_KEY'))) {
            throw new LogException('There no ACCESS_KEY on servers', 406);
        } elseif ($request->getSession()->get('attempts') >= 10) {
            throw new LogException('Please try again later', 405);
        } elseif (!$request->has('key')) {
            throw new LogException('Mismatch key', 403);
        } elseif ($request->get('key') != env('ACCESS_KEY')) {
            if (!env('APP_DEBUG')) {
                $request->getSession()->increment('attempts');
            }
            throw new LogException('ACCESS_KEY didn\'t matched', 401);
        }
        $request->getSession()->forget('attempts');
        return $next($request);
    }
}
