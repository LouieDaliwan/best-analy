<?php

namespace Best\Http\Controllers\Api;

use Best\Services\ReportServiceInterface;
use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Survey\Models\Survey;

class GeneratePerformanceIndexReport extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request              $request
     * @param  \Best\Services\ReportServiceInterface $service
     * @param  \Survey\Models\Survey                 $survey
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ReportServiceInterface $service, Survey $survey)
    {
        return response()->json($service->generate($survey, $request->all()));
    }
}
