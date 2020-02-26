<?php

namespace Team\Providers;

use Team\Services\TeamService;
use Team\Services\TeamServiceInterface;
use Core\Providers\BaseServiceProvider;

class TeamServiceProvider extends BaseServiceProvider
{
    /**
     * Array of providers to register.
     *
     * @var array
     */
    protected $providers = [];

    /**
     * Register any service class with its interface.
     *
     * @return void
     */
    protected function registerServiceBindings()
    {
        $this->app->bind(TeamServiceInterface::class, TeamService::class);
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
}
