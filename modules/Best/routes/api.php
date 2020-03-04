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
    Route::get('reports/{report}/download', 'Api\DownloadPerformanceIndexReport')->name('reports.show');
    Route::get('reports/{report}', 'Api\GetReport');
});

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::post('reports/{survey}/generate', 'Api\GeneratePerformanceIndexReport')->name('surveys.report');
});
