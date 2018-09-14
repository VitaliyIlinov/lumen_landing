<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        if ($e instanceof LogException)  {
            $e->report();
        }
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
//        if (env('APP_DEBUG')) {
//            return parent::render($request, $e);
//        }

        if ($e instanceof ValidationException && $e->getResponse()) {
            return $e->getResponse();
        }elseif ($e instanceof LogException)  {
            return $e->render($request);
        }

        return response()->json(
            [
                'name' => (new \ReflectionClass($e))->getShortName(),
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ],
            method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500
        );

    }

}