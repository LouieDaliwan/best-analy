<?php

namespace Index\Providers;

use Index\Services\IndexService;
use Index\Services\IndexServiceInterface;
use Core\Providers\BaseServiceProvider;

class IndexServiceProvider extends BaseServiceProvider
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
        $this->app->bind(IndexServiceInterface::class, IndexService::class);
    }
}
