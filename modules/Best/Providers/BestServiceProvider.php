<?php

namespace Survey\Providers;

use Best\Services\ReportService;
use Best\Services\ReportServiceInterface;
use Core\Providers\BaseServiceProvider;
use Survey\Services\FieldService;
use Survey\Services\FieldServiceInterface;
use Survey\Services\SubmissionService;
use Survey\Services\SubmissionServiceInterface;
use Survey\Services\SurveyService;
use Survey\Services\SurveyServiceInterface;

class BestServiceProvider extends BaseServiceProvider
{
    /**
     * Array of providers to register.
     *
     * @var array
     */
    protected $providers = [
        EventServiceProvider::class,
    ];

    /**
     * Register any service class with its interface.
     *
     * @return void
     */
    protected function registerServiceBindings()
    {
        $this->app->bind(ReportServiceInterface::class, ReportService::class);
    }
}
