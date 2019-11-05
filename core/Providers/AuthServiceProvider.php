<?php

namespace Core\Providers;

use Core\Http\Guards\AdminGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerAdminGuard();
    }

    /**
     * Register the auth:admin guard
     * used in all routes/admin.php middleware.
     *
     * @return void
     */
    protected function registerAdminGuard()
    {
        Auth::extend('admin', function ($app, $name, array $config) {
            return new AdminGuard($app->request, Auth::createUserProvider($config['provider']));
        });
    }
}
