<?php

namespace App\Http\Middleware;

use App\Services\Fraud;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory as ViewFactory;

class FraudMiddleware
{
    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Create a new error binder instance.
     *
     * @param  \Illuminate\Contracts\View\Factory  $view
     * @return void
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        if (env('FRAUDFILTER')) {
            $fraud = new Fraud($request);
            $request->merge(['pageType'=>$fraud->sendFraudRequest()]);
        }
        return $next($request);
    }
}
