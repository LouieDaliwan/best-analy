<?php

Route::prefix('v1')->middleware(['auth:api', 'json.force', 'auth.permissions'])->group(function () {
    Route::get('surveys/{survey}/submissions/get', 'Api\GetSurveySubmission')->name('surveys.submission');
    Route::get('surveys/{survey}/submissions', 'Api\SubmitSurvey')->name('surveys.submissions');
    Route::post('surveys/{survey}/submit', 'Api\SubmitSurvey')->name('surveys.submit');

    Route::softDeletes('surveys', 'Api\SurveyController');
    Route::apiResource('surveys', 'Api\SurveyController');

    Route::apiResource('submissions', 'Api\SubmissionController');
});
