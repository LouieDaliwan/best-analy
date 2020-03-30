<?php

/**
 *------------------------------------------------------------------------------
 * API Routes
 *------------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
 */

Route::prefix('v1')->group(function () {
    Route::get('reports/misc/months/all', 'Api\GetReportsMonths');
    Route::get('reports/{report}/download', 'Api\DownloadPerformanceIndexReport')->name('reports.show');
    Route::get('reports/{report}', 'Api\GetReport');
});

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get(
        'reports/overall/customer/{customer}/user/{user}',
        'Api\GetUserCustomerOverallReport'
    )->name('reports.user');

    Route::get('reports/customer/{customer}/user/{user}', 'Api\GetUserCustomerReportsList')->name('reports.user');
    Route::post('reports/{survey}/generate', 'Api\GeneratePerformanceIndexReport')->name('surveys.report');
    Route::get('reports', 'Api\Report\GetReportList')->name('reports.index');
    Route::get('reports/{report}', 'Api\Report\GetReport')->name('reports.single');
    Route::delete('reports/{report}', 'Api\Report\DeleteReport')->name('reports.delete');
});
