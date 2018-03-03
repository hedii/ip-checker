<?php

namespace Hedii\IpChecker;

use Hedii\IpChecker\Commands\CheckIpAddress;
use Hedii\IpChecker\Events\IpAddressCheckFailedEvent;
use Hedii\IpChecker\Listeners\SendIpAddressIsFailingNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class IpCheckerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->publishes([__DIR__ . '/../config/ip-checker.php' => config_path('ip-checker.php')], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([CheckIpAddress::class]);
        }

        Event::listen(IpAddressCheckFailedEvent::class, SendIpAddressIsFailingNotification::class);
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ip-checker.php', 'ip-checker');

        $this->app->singleton(IpChecker::class, function ($app) {
            return new IpChecker($app['config']);
        });
    }
}
