<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;


class LogException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //todo send erros to server  Log::info('test');
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function render(Request $request)
    {
        $redirect= redirect()->to('404');
        $redirect->setSession($request->getSession());
        return $redirect->withErrors($this->getCode().' '. $this->getMessage());
    }
}