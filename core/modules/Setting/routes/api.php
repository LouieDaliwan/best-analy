<?php

Route::prefix('v1/settings')->middleware(['auth:api', 'auth.permissions'])->group(function () {
    Route::get('branding', 'Api\BrandingController');
});

Route::prefix('v1')->middleware(['auth:api', 'auth.permissions'])->group(function () {
    Route::post('settings', 'Api\SaveSettings');
});
