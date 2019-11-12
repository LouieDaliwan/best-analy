<?php

namespace Subscription\Providers;

use Core\Providers\BaseServiceProvider;
use Subscription\Http\Routing\SubscriptionRouteMacro;
use Subscription\Services\SubscriptionService;
use Subscription\Services\SubscriptionServiceInterface;

class SubscriptionServiceProvider extends BaseServiceProvider
{
    /**
     * Array of providers to register.
     *
     * @var array
     */
    protected $providers = [];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->registerRouteMacros();
    }

    /**
     * Register any service class with its interface.
     *
     * @return void
     */
    protected function registerServiceBindings()
    {
        $this->app->bind(SubscriptionServiceInterface::class, SubscriptionService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Get the base directory.
     *
     * @param  string $path
     * @return string
     */
    protected function directory(string $path = '')
    {
        return dirname(__DIR__).DIRECTORY_SEPARATOR.$path;
    }

    /**
     * Register all core route macros.
     *
     * @return void
     */
    protected function registerRouteMacros()
    {
        SubscriptionRouteMacro::register();
    }
}
