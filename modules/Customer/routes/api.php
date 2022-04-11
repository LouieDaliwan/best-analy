<?php

Route::prefix('v1')->middleware(['auth:api', 'json.force', 'auth.permissions'])->group(function () {
    Route::get('customers/{customer}/reports', 'Api\GetCustomerReportsList')->name('customers.reports');
    Route::get('customer/{customer}/financial-ratios', 'Api\CustomerFinancialRatiosController')->name('customers.financialRatios');
    Route::softDeletes('customers', 'Api\CustomerController');
    Route::ownedResource('customers', 'Api\CustomerController@owned');
    Route::apiResource('customers', 'Api\CustomerController');
    Route::softDeletes('customers/{customer}/ratios/{ratio}', 'Api\CustomerStatementsController@destroy');

});

Route::prefix('v1')->middleware(['auth:api', 'json.force'])->group(function () {
    Route::post('crm/customers/update', 'Api\Crm\SaveFoundCustomerFromCrm')->name('crm.update');
    Route::post('crm/report/send', 'Api\Crm\SendReportDocumentToCrm')->name('crm.report');
    Route::post('crm/financial/send', 'Api\Crm\SendFinancialDataToCrm')->name('crm.financial');
    Route::post('crm/customers/save', 'Api\Crm\SaveUpdatedCustomerDataToCrm')->name('crm.save');
    Route::get('crm/customers/search/{crmnumber}', 'Api\Crm\FindCustomerFromCrm')->name('crm.search');
});

Route::prefix('v1')->group(function () {
    Route::get('crm/customers/{crmnumber}/financial/ratios', 'Api\Crm\GetCustomerFinancialRatios');
});
