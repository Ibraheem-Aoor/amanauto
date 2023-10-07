<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;
use App\Channels\TranslateDatabaseNotificationChannel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class); //disabled in config/app.php for live env
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Notification::extend('trans-database', function ($app) {
            return new TranslateDatabaseNotificationChannel();
        });
    }
}
