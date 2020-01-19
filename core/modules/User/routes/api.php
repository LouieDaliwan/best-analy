<?php

Route::prefix('v1')->middleware(['auth:api', 'auth.permissions'])->group(function () {
    Route::softDeletes('users/roles', 'Api\RoleController');
    Route::resource('users/roles', 'Api\RoleController');

    Route::softDeletes('users', 'Api\UserController');
    Route::apiResource('users', 'Api\UserController');
});
