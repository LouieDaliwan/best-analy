<?php

namespace Survey\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Survey\Http\Requests\SubmissionRequest;
use Survey\Models\Survey;
use Survey\Services\SurveyServiceInterface;

class SubmitSurvey extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Survey\Http\Requests\SubmissionRequest $request
     * @param  \Survey\Models\Survey                   $survey
     * @param  \Survey\Services\SurveyServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SubmissionRequest $request, Survey $survey, SurveyServiceInterface $service)
    {
        return response()->json($service->submit($survey));
    }
}
