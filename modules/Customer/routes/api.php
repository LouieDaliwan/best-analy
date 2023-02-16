<?php

Route::prefix('v1')->middleware(['auth:api', 'json.force', 'auth.permissions'])->group(function () {
    Route::get('customers/{customer}/reports', 'Api\GetCustomerReportsList')->name('customers.reports');
    Route::get('customers/{customer}/sdmi', 'Api\CustomerSdmiController');
    Route::post('customers/{customer}/update-audit', 'Api\CustomerController@updateAudit');
    Route::softDeletes('customers', 'Api\CustomerController');
    Route::ownedResource('customers', 'Api\CustomerController@owned');
    Route::apiResource('customers', 'Api\CustomerController');
});

Route::prefix('v1')->middleware(['auth:api', 'json.force'])->group(function () {
    Route::delete('customers/{customer}/ratios/{ratio}/delete', 'Api\CustomerStatementsController@destroy');
});

Route::prefix('v1')->middleware(['auth:api', 'json.force'])->group(function () {
    Route::get('customer/{customer}/financial-ratios', 'Api\CustomerFinancialRatiosController')->name('customers.financialRatios');
    Route::post('crm/customers/update', 'Api\Crm\SaveFoundCustomerFromCrm')->name('crm.update');
    Route::post('crm/report/send', 'Api\Crm\SendReportDocumentToCrm')->name('crm.report');
    Route::post('crm/financial/send', 'Api\Crm\SendFinancialDataToCrm')->name('crm.financial');
    Route::post('crm/customers/save', 'Api\Crm\SaveUpdatedCustomerDataToCrm')->name('crm.save');
    Route::post('crm/financial-file-no/send', 'Api\Crm\SendVisitUpdateToCrm')->name('crm.financialByFile');
    Route::post('crm/visit-update/send', 'Api\Crm\SendVisitUpdateToCrm')->name('crm.visitUpdate');
    Route::get('crm/customers/search/{crmnumber}', 'Api\Crm\FindCustomerFromCrm')->name('crm.search');
});

Route::prefix('v1')->group(function () {
    Route::get('crm/customers/{crmnumber}/financial/ratios', 'Api\Crm\GetCustomerFinancialRatios');
    Route::post('customers/check-temp-trashed', 'Api\CheckCustomerTrashedController@store');
});
