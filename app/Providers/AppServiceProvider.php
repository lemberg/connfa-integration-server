<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('greater_than_field', function($attribute, $value, $parameters, $validator) {
            $minField = $parameters[0];
            $data = $validator->getData();
            $minValue = $data[$minField];
            return $value > $minValue;
        });
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

        $this->app->singleton('conference_service', \App\Services\ConferenceService::class);
    }
}
