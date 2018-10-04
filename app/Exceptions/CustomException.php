<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class CustomException extends Exception
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

        if(View::exists($view ="errors.{$this->getCode()}")){
            return response(view($view,[
                'msg'=>$this->getMessage()
            ]),$this->getCode());
        }
        return response(view('errors.error',['msg'=>$this->getMessage()]),$this->getCode());
    }
}