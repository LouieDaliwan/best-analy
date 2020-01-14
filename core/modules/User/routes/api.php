<?php

Route::prefix('v1')->middleware(['auth:api', 'auth.permissions'])->group(function () {
    Route::softDeletes('users', 'Api\UserController');
    Route::apiResource('users', 'Api\UserController');
});
