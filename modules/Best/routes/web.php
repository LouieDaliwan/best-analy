<?php

use Best\Models\Report;
use Best\Services\FormulaServiceInterface;
use Best\Services\ReportServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;
use Survey\Models\Survey;
use User\Models\User;

Route::post('reports/{report}/download', 'Api\DownloadPerformanceIndexReport');
Route::post('reports/download', 'Api\DownloadPerformanceIndexReport')->name('reports.download');

// Using this on frontend.
Route::get('best/reports/{report}/pdf', 'Api\GetPerformanceIndexPdfReport')->name('reports.show');
Route::get('best/reports/{report}', 'Api\GetPerformanceIndexReport')->name('reports.show');

Route::get('best/preview/reports/overall', function (Request $request, FormulaServiceInterface $service) {
    $file = $request->get('month') ?: date('m-Y');
    $user = User::find($request->get('user_id'));
    Auth::login($user);

    $attributes = ['customer_id' => $request->get('customer_id')];
    $data = $service->generate(\Survey\Models\Survey::find(1), $attributes);

    return view("best::reports.overall")->withData($data);
});

Route::get(
    'best/preview/reports/{report}',
    function (Request $request, Report $report, FormulaServiceInterface $service) {
        $file = $request->get('type') ?: 'index';
        $taxonomy_id = $request->get('taxonomy_id');

        Auth::login($report->user);

        $attributes = ['customer_id' => $report->customer->getKey(), 'taxonomy_id' => $taxonomy_id];
        $data = $service->generate($report->survey, $attributes);

        return view("best::reports.$file")->withData($data);
    }
);

Route::get(
    'best/preview/reports/{report}/pdf',
    function (Request $request, Report $report, FormulaServiceInterface $service) {
        $file = $request->get('type') ?: 'index';
        $taxonomy_id = $request->get('taxonomy_id');

        Auth::login($report->user);

        $attributes = ['customer_id' => $report->customer->getKey(), 'taxonomy_id' => $taxonomy_id];
        $data = $service->generate($report->survey, $attributes);

        return view("best::reports.pdf.$file")->withData($data);
    }
);
