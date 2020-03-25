<?php

namespace Best\Http\Controllers\Api;

use Best\Services\FormulaServiceInterface;
use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Survey\Models\Survey;

class GeneratePerformanceIndexReport extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request               $request
     * @param  \Best\Services\FormulaServiceInterface $service
     * @param  \Survey\Models\Survey                  $survey
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, FormulaServiceInterface $service, Survey $survey)
    {
        return $service->generate($survey, $request->all());
    }
}