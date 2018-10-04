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
     * @param  \Illuminate\Contracts\View\Factory $view
     * @return void
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    /**
     * @param Request $request
     * @param Closure $nextfinds
     * @return mixed
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        $isClocked = Fraud::SAFE;
        if (Fraud::getFraudFilter()) {
            $isClocked = (new Fraud($request))->isCloaked();
        }
        session()->put(['pageType' => $isClocked]);
        return $next($request);
    }
}
