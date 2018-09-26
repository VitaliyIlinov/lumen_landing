<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogException extends Exception
{

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        Log::info($this->getMessage());
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function render(Request $request)
    {
        $redirect = redirect()->to('error');
        $redirect->setSession($request->getSession());
        return $redirect->withErrors($this->getCode() . ' ' . $this->getMessage());
    }
}