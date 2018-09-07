<?php

namespace App\Http\Middleware;

use App\Services\Fraud;
use Closure;
use Illuminate\Http\Request;

class FraudMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (env('FRAUDFILTER')) {
            $fraud = new Fraud($request);
            $request->request->add(['pageType',$fraud->sendFraudRequest()]);
        }

        return $next($request);
    }
}
