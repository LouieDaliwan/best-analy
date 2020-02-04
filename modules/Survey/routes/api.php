<?php

Route::prefix('v1')->middleware(['auth:api', 'json.force', 'auth.permissions'])->group(function () {
    Route::softDeletes('surveys', 'Api\SurveyController');
    Route::apiResource('surveys', 'Api\SurveyController');

    Route::apiResource('submissions', 'Api\SubmissionController');
});
