<?php

namespace Customer\Providers;

use Core\Providers\BaseServiceProvider;
use Customer\Services\CustomerService;
use Customer\Services\CustomerServiceInterface;
use Customer\Support\Crm\Contracts\CrmApiInterface;
use Customer\Support\Crm\Contracts\CrmInterface;
use Customer\Support\Crm\Crm;
use Customer\Support\Crm\CrmApi;
use Customer\Support\Crm\FileNumber;
use GuzzleHttp\Client as GuzzleClient;

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

        $this->registerCrmBindings();

        $this->registerCrmRouteBindings();
    }

    /**
     * Register the CRM bindings.
     *
     * @return void
     */
    protected function registerCrmBindings()
    {
        $this->app->singleton(CrmApi::class, function () {
            return new CrmApi(new GuzzleClient(config('modules.customer.crm.client')));
        });

        $this->app->bind(CrmInterface::class, Crm::class);
        $this->app->singleton(Crm::class, function ($app) {
            return new Crm(
                $app[CrmApi::class],
                config('modules.customer.crm.api', [])
            );
        });
    }

    /**
     * Register the CRM Route bindings.
     *
     * @return void
     */
    protected function registerCrmRouteBindings()
    {
        $this->app['router']->bind('crmnumber', function ($crmnumber) {
            return new FileNumber($crmnumber);
        });
    }
}
