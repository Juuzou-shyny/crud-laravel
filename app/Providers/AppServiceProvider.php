<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Factory as FakerFactory;
use Faker\Generator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            return FakerFactory::create('es_ES');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
                // Forzar Faker a español en toda la aplicación
                $this->app->singleton(Generator::class, function () {
                    return FakerFactory::create('es_ES');
                });
    }
}
