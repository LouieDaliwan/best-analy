<?php

namespace Core\Providers;

use Core\Application\Permissions\PermissionsPolicy;
use Illuminate\Support\ServiceProvider;
use User\Services\PermissionServiceInterface;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('core.permissions', function ($app) {
            return new PermissionsPolicy($app[PermissionServiceInterface::class]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['core.permissions']->bootGateDefinitionsBefore();

        $this->app['core.permissions']->bootGateDefinitions();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['core.permissions'];
    }
}
