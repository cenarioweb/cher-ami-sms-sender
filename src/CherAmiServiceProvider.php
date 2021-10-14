<?php

namespace CenarioWeb\CherAmi;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CherAmiServiceProvider extends ServiceProvider
{
    public function boot ()
    {
        $this->publishes([
            __DIR__.'/../config/sms.php' => config_path('sms.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/sms.php';
        $this->mergeConfigFrom($configPath, 'sms');

        App::bind('sms', function () {
            return new FactoryClient();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
