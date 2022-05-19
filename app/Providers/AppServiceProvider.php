<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Contracts\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' && config('app.env') !== 'local') {
            $this->app['request']->server->set('HTTPS', true);
        }
//        if (config('app.env') !== 'local') {
//            $this->app['request']->server->set('HTTPS', true);
//        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' && config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
//        if (config('app.env') !== 'local') {
//            URL::forceScheme('https');
//        }
    }
}
