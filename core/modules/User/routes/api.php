<?php

Route::prefix('v1')->middleware(['auth:api', 'auth.permissions'])->group(function () {
    Route::softDeletes('roles', 'Api\RoleController');
    Route::resource('roles', 'Api\RoleController');

    Route::softDeletes('users', 'Api\UserController');
    Route::apiResource('users', 'Api\UserController');
});
