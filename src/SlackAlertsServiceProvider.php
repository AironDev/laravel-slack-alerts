<?php

namespace Airon\SlackAlerts;

use Airon\LaravelPackageTools\Package;
use Airon\LaravelPackageTools\PackageServiceProvider;

class SlackAlertsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-slack-alerts')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->bind('laravel-slack-alerts', function () {
            return new SlackAlert();
        });
    }
}
