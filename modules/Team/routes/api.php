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

Route::prefix('v1')->middleware('auth:api', 'auth.permissions')->group(function () {
    Route::ownedResource('teams', 'Api\GetOwnedTeamMembersList');
    Route::portResource('teams', 'Api\CustomerReport');
    Route::softDeletes('teams', 'Api\TeamController');
    Route::apiResource('teams', 'Api\TeamController');
});
