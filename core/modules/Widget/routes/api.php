<?php


/**
 *------------------------------------------------------------------------------
 * App Widgets Route
 *------------------------------------------------------------------------------
 *
 * Here is where you can register API routes for retrieving
 * widgets.
 *
 */

Route::middleware(['auth:api', 'json.force'])->prefix('v1')->group(function () {
    Route::get('widgets', 'Api\AppWidgets')->name('widgets.index');
});
