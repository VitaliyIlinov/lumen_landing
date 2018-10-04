<?php

namespace App\Http\Middleware;

use App\Exceptions\CodeException;
use App\Traits\ApiResponse;
use Closure;

class TrapMiddleware
{

    use ApiResponse;

    protected function getFilePath()
    {
        $loggingConfig = config('logging');
        return $loggingConfig['channels']['blacklist']['path'];
    }


    public function handle($request, Closure $next)
    {
        $ips = array_column($this->jsonToArray($this->getLogsArr()), 'ip');
        if (in_array($request->ip(), $ips)) {
            throw new CodeException('You Are in Block!',404);
        }
        return $next($request);
    }
}