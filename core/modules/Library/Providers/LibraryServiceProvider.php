<?php

namespace Library\Providers;

use Core\Providers\BaseServiceProvider;
use Library\Services\LibraryService;
use Library\Services\LibraryServiceInterface;

class LibraryServiceProvider extends BaseServiceProvider
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
        $this->app->bind(LibraryServiceInterface::class, LibraryService::class);
    }
}
