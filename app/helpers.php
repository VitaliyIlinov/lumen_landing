<?php

use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\Debug\ExceptionHandler;

if (!function_exists('session')) {
    /**
     * Get / set the specified session value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string $key
     * @param  mixed        $default
     * @return mixed|\Illuminate\Session\Store|\Illuminate\Session\SessionManager
     */
    function session($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('request')->session();
        }

        if (is_array($key)) {
            return app('request')->session()->put($key);
        }

        return app('request')->session()->get($key, $default);
    }
}

if (!function_exists('request')) {
    /**
     * Get an instance of the current request or an input item from the request.
     *
     * @param  array|string $key
     * @param  mixed        $default
     * @return \Illuminate\Http\Request|string|array
     */
    function request($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('request');
        }

        if (is_array($key)) {
            return app('request')->only($key);
        }

        $value = app('request')->__get($key);

        return is_null($value) ? value($default) : $value;
    }
}

if (!function_exists('old')) {
    /**
     * Retrieve an old input item.
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    function old($key = null, $default = null)
    {
        return app('request')->old($key, $default);
    }
}

if (!function_exists('report')) {
    /**
     * Report an exception.
     *
     * @param  \Exception $exception
     * @return void
     */
    function report($exception)
    {
        if ($exception instanceof Throwable &&
            !$exception instanceof Exception) {
            $exception = new FatalThrowableError($exception);
        }

        app(ExceptionHandler::class)->report($exception);
    }
}

if (!function_exists('asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string $path
     * @param  bool   $secure
     * @return string
     */
    function asset($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
}