<?php

namespace Survey\Providers;

use Best\Events\ReportGenerated;
use Best\Listeners\CalculateFieldSubmissionSubScore;
use Best\Listeners\ComputePerformanceIndexFromSurvey;
use Best\Listeners\SaveGeneratedReport;
use Core\Providers\EventServiceProvider as BaseEventServiceProvider;
use Survey\Events\SurveySubmittedByUser;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SurveySubmittedByUser::class => [
            CalculateFieldSubmissionSubScore::class,
            ComputePerformanceIndexFromSurvey::class,
        ],
        ReportGenerated::class => [
            SaveGeneratedReport::class,
        ],
    ];
}
