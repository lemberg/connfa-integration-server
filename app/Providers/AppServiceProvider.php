<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('League\Fractal\Manager', function($app) {
            $fractal = new Manager;

            $serializer = new ArraySerializer();

            $fractal->setSerializer($serializer);

            return $fractal;
        });

    }
}
