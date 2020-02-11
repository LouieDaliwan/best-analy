<?php

namespace Survey\Providers;

use Core\Providers\BaseServiceProvider;
use Survey\Models\Field;
use Survey\Observers\FieldObserver;
use Survey\Services\FieldService;
use Survey\Services\FieldServiceInterface;
use Survey\Services\SubmissionService;
use Survey\Services\SubmissionServiceInterface;
use Survey\Services\SurveyService;
use Survey\Services\SurveyServiceInterface;

class SurveyServiceProvider extends BaseServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [Field::class => FieldObserver::class],
    ];

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
