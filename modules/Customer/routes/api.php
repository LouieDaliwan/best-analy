<?php

Route::prefix('v1')->middleware(['auth:api', 'json.force', 'auth.permissions'])->group(function () {
    Route::softDeletes('customers', 'Api\CustomerController');
    Route::apiResource('customers', 'Api\CustomerController');
});

Route::prefix('v1')->middleware(['auth:api', 'json.force'])->group(function () {
    Route::post('crm/customers/save', 'Api\Crm\SaveUpdatedCustomerDataToCrm')->name('crm.save');
    Route::get('crm/customers/search/{crmnumber}', 'Api\Crm\FindCustomerFromCrm')->name('crm.search');
});
