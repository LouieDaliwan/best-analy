<?php

namespace Survey\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Survey\Http\Controllers\Controller;
use Survey\Models\Survey;
use Survey\Services\SurveyServiceInterface;

class GetSurveySubmission extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request                $request
     * @param  \Survey\Models\Survey                   $survey
     * @param  \Survey\Services\SurveyServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Survey $survey, SurveyServiceInterface $service)
    {
        return response()->json($service->findSubmission($survey, $request->all()));
    }
}
