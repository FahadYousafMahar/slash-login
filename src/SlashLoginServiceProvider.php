<?php

namespace FahadYousafMahar\SlashLogin;

use Illuminate\Support\ServiceProvider;

class SlashLoginServiceProvider extends ServiceProvider
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

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/slash-login.php' => config_path('slash-login.php'),
            ], 'slash-login-config');
        }

        $this->configure();
        $this->loadRoutes();
    }

    public function loadRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Configure the package.
     *
     * @return void
     */
    protected function configure()
    {
        if (!config('slash-login.route')) {
            $this->mergeConfigFrom(__DIR__ . '/../config/slash-login.php', 'slash-login');
        }
    }
}
