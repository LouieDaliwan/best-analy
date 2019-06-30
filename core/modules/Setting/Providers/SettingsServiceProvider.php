<?php

namespace Setting\Providers;

use Core\Providers\BaseServiceProvider;
use Setting\Services\SettingService;
use Setting\Services\SettingServiceInterface;

class SettingsServiceProvider extends BaseServiceProvider
{
    /**
     * Array of providers to register.
     *
     * @var array
     */
    protected $providers = [
        //
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
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
