<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
       // HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        CodeException::class,
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $e
     * @throws Exception
     */
    public function report(Exception $e)
    {
        if ($this->shouldntReport($e)) {
            return;
        }

        try {
            $logger = app('Psr\Log\LoggerInterface');
        } catch (Exception $ex) {
            throw $e; // throw the original exception
        }

        //config.logging.default
        if($e instanceof BlackListException){
            $logger->setDefaultDriver('blacklist');
        }
        $logger->error($e, ['exception' => $e]);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception                $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \ReflectionException
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof LogException && !$request->expectsJson()) {
            return $e->render($request);
        }elseif ($e instanceof NotFoundHttpException){
            return redirect()->route('home');
        }elseif ($e instanceof CodeException){
            return $e->render($request);
        }

        return $request->expectsJson()
            ? response()->json(['message' => $e->getMessage(), 'name' => (new \ReflectionClass($e))->getShortName()], $e->getCode())
            : parent::render($request, $e);
    }

}