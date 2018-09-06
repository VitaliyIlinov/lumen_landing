<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LandingController extends Controller
{

    public function __construct()
    {

    }


    public function safe(Request $request) {
        if (!env('FRAUDFILTER')) {
            return $this->getMoneyPage();
        }
        if (view()->exists('safe/index')) {
            return view('safe/index');
        }
    }

    public function money(Request $request) {

      return $this->getMoneyPage();

    }


    private function getMoneyPage() {
        if (view()->exists('money/index')) {
            return view('money/index');
        }
    }



}
