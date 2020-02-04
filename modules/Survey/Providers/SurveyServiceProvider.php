<?php

namespace Survey\Providers;

use Core\Providers\BaseServiceProvider;
use Survey\Services\FieldService;
use Survey\Services\FieldServiceInterface;
use Survey\Services\SubmissionService;
use Survey\Services\SubmissionServiceInterface;
use Survey\Services\SurveyService;
use Survey\Services\SurveyServiceInterface;

class SurveyServiceProvider extends BaseServiceProvider
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
    public function registerServiceBindings()
    {
        $this->app->bind(FieldServiceInterface::class, FieldService::class);
        $this->app->bind(SubmissionServiceInterface::class, SubmissionService::class);
        $this->app->bind(SurveyServiceInterface::class, SurveyService::class);
    }
}
