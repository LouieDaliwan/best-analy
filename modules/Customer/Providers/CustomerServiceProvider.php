<?php

namespace Customer\Providers;

use Customer\Services\CustomerService;
use Customer\Services\CustomerServiceInterface;
use Core\Providers\BaseServiceProvider;

class CustomerServiceProvider extends BaseServiceProvider
{
    /**
     * Array of providers to register.
     *
     * @var array
     */
    protected $providers = [];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
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
}
