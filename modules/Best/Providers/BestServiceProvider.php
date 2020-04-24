<?php

namespace Survey\Providers;

use Best\Services\FormulaService;
use Best\Services\FormulaServiceInterface;
use Best\Services\ReportService;
use Best\Services\ReportServiceInterface;
use Best\Services\SettingService;
use Best\Services\SettingServiceInterface;
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
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->loadTranslationFiles();
    }

    /**
     * Register any service class with its interface.
     *
     * @return void
     */
    protected function registerServiceBindings()
    {
        $this->app->bind(FormulaServiceInterface::class, FormulaService::class);
        $this->app->bind(ReportServiceInterface::class, ReportService::class);
        $this->app->bind(SettingServiceInterface::class, SettingService::class);
    }

    /**
     * Register translation files.
     *
     * @return void
     */
    public function loadTranslationFiles()
    {
        $this->loadJsonTranslationsFrom($this->directory('resources/lang'));
        $this->loadTranslationsFrom($this->directory('resources/lang'), 'best');
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
