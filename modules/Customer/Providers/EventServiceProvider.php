<?php

namespace Customer\Providers;

use Customer\Services\CustomerService;
use Customer\Services\CustomerServiceInterface;
use Core\Providers\BaseServiceProvider;
use Core\Providers\EventServiceProvider as BaseEventServiceProvider;
use Customer\Events\ApplicantSaved;
use Customer\Listeners\AssignUser;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ApplicantSaved::class => [
            AssignUser::class,
        ],

    ];
}
