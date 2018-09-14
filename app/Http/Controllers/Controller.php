<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function redirectBackWithErrors(Request $request ,ValidationException $validator)
    {
        $request->session()->flash('errors',$validator->validator->getMessageBag());
        $request->flash();
        return redirect()->to($request->session()->previousUrl());
    }
}
