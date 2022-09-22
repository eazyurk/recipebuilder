<?php

namespace App\Providers;

use App\Services\AlbertHeijnService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(
            abstract: AlbertHeijnService::class,
            concrete: fn() => new AlbertHeijnService(
                headers: config('services.albert_heijn.headers'),
                baseUrl: strval(config('services.albert_heijn.base_url')),
            )
        );
    }
}
