<?php

Route::prefix('v1')->middleware(['auth:api', 'json.force', 'auth.permissions'])->group(function () {
    Route::get('customers/{customer}/reports', 'Api\GetCustomerReportsList')->name('customers.reports');
    Route::softDeletes('customers', 'Api\CustomerController');
    Route::ownedResource('customers', 'Api\CustomerController@owned');
    Route::apiResource('customers', 'Api\CustomerController');
});

Route::prefix('v1')->middleware(['auth:api', 'json.force'])->group(function () {
    Route::post('crm/customers/update', 'Api\Crm\SaveFoundCustomerFromCrm')->name('crm.update');
    Route::post('crm/report/send', 'Api\Crm\SendReportDocumentToCrm')->name('crm.update');
    Route::post('crm/customers/save', 'Api\Crm\SaveUpdatedCustomerDataToCrm')->name('crm.save');
    Route::get('crm/customers/search/{crmnumber}', 'Api\Crm\FindCustomerFromCrm')->name('crm.search');
});

Route::prefix('v1')->group(function () {
    Route::get('crm/customers/{crmnumber}/financial/ratios', 'Api\Crm\GetCustomerFinancialRatios');
});
