<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        $path = base_path('public').DIRECTORY_SEPARATOR;
        View::addNamespace('Safe', $path.'s');
        View::addNamespace('Money', $path.'m');

        Blade::if('env', function ($envKey, $value) {
            return env($envKey) == $value;
        });
    }
}
