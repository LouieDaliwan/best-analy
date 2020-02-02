<?php

namespace Taxonomy\Providers;

use Taxonomy\Services\TaxonomyService;
use Taxonomy\Services\TaxonomyServiceInterface;
use Core\Providers\BaseServiceProvider;

class TaxonomyServiceProvider extends BaseServiceProvider
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
        $this->app->bind(TaxonomyServiceInterface::class, TaxonomyService::class);
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
