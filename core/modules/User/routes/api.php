<?php

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::apiResource('users', 'Api\UserController');
});
