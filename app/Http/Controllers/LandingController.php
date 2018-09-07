<?php

namespace App\Http\Controllers;

use App\Services\Fraud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LandingController extends Controller
{

    public function safe(Request $request) {

        if ($request->has('pageType')) {
            return $this->getMoneyPage();
        }

        if (view()->exists('safe/index')) {
            return view('safe/index');
        }
    }


    public function money() {
      return $this->getMoneyPage();
    }


    public function moneySecondPage() {
        if (view()->exists('money/secod')) {
            return view('money/second');
        }
    }


    private function getMoneyPage() {
        if (view()->exists('money/index')) {
            return view('money/index');
        }
    }



}
