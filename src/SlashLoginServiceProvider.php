<?php

namespace FahadYousafMahar\SlashLogin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/slash-login.php' => config_path('slash-login.php'),
            ], 'slash-login');
        }

        $this->configure();
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        return $this;
     }

    /**
     * Configure the package.
     *
     * @return void
     */
    protected function configure()
    {
        if (!config('slash-login.route', null))
            $this->mergeConfigFrom(__DIR__.'/../config/slash-login.php', 'slash-login');
    }
}