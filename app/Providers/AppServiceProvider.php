<?php

namespace App\Providers;

use App\Services\MailGunService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
        Paginator::useBootstrapFive();
        view()->composer('*', function($view){
           $view->with('user', Auth::user());
        });
        $this->app->singleton(
            abstract: MailGunService::class,
            concrete: fn() => new MailGunService(
                baseUrl: strval(config('services.mailgun.endpoint')),
                apiToken: strval(config('services.mailgun.token'))
            )
        );
        $this->loadMigrationsFrom(base_path('database/migrations/exclude'));
    }
}
