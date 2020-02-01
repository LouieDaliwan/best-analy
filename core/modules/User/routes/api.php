<?php

Route::prefix('v1/users')->middleware(['auth:api', 'auth.permissions'])->group(function () {
    Route::softDeletes('roles', 'Api\RoleController');
    Route::apiResource('roles', 'Api\RoleController');

    Route::get('permissions', 'Api\GetPermissionsList')->name('permissions.index');
});

Route::prefix('v1')->middleware(['auth:api', 'auth.permissions'])->group(function () {
    Route::softDeletes('users', 'Api\UserController');
    Route::apiResource('users', 'Api\UserController');
});
