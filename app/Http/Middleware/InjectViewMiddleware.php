<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InjectViewMiddleware
{

    private function getTrap()
    {
        return '<a href="' . route('trap') . '" style="display: none;">trap</a>';
    }


    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->original->getName() == 'Money::index') {
            $content = preg_replace('#(\<body(.*)\>)#', '${1}' . $this->getTrap(), $response->content());
            $response->setContent($content);
        }

        return $response;
    }
}
