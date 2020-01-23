<?php

namespace Moathdev\PolygonMap;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::provideToScript([
                'googleMapsKey' => env('GOOGLE_MAPS_KEY'),
            ]);

            Nova::script('fields', __DIR__ . '/../dist/js/index.js');
            Nova::style('fields', __DIR__ . '/../dist/css/index.css');
        });
    }

    public function register()
    {
        //
    }
}
