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

Route::get('best/formula/check', function (Request $request) {
    $method = $request->get('type');
    $attributes = $request->get('attributes');
    $service = app(FormulaServiceInterface::class);

    switch ($method) {
        case 'getOverallFindingsComment':
            $attributes = (array) json_decode($attributes);
            $results = $service->{$method}($attributes['index'], 'CompanyName', $attributes['total']);
            break;

        case 'getFirstBoxComment':
            $attributes = (array) json_decode($attributes);
            $group = collect($attributes['group']);
            $results[0] = $service->{$method}($group, $attributes['index']);
            $results[1] = $service->getSecondBoxComment($group, $attributes['index']);
            break;

        case 'getKeyEnablers':
            $attributes = (array) json_decode($attributes);
            Auth::login(\User\Models\User::find($attributes['user_id']));
            $survey = \Survey\Models\Survey::find($attributes['survey_id']);
            $results = $service->generate($survey, $attributes);
            $results = $results['indices'][strtoupper($attributes['index'])]['key:enablers']['data'];
            break;

        case 'getKeyStrategicRecommendations':
            $attributes = (array) json_decode($attributes);
            Auth::login(\User\Models\User::find($attributes['user_id']));
            $survey = \Survey\Models\Survey::find($attributes['survey_id']);
            $results = $service->generate($survey, $attributes);
            $results = $results['indices'][strtoupper($attributes['index'])]['key:recommendations'];
            break;

        default:
            $results = '';
            break;
    }//end switch

    return response()->json($results);
});

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
        app()->setLocale($request->get('lang') ?: 'en');

        $file = $request->get('type') ?: 'index';
        $taxonomy_id = $request->get('taxonomy_id');

        Auth::login($report->user);

        $attributes = ['customer_id' => $report->customer->getKey(), 'taxonomy_id' => $taxonomy_id];
        $data = $service->generate($report->survey, $attributes);

        return view("best::reports.$file")->withData($data);
    }
);

Route::get(
    'best/preview/reports/{report}/data',
    function (Request $request, Report $report, FormulaServiceInterface $service) {
        $file = $request->get('type') ?: 'index';
        $taxonomy_id = $request->get('taxonomy_id');

        Auth::login($report->user);

        $attributes = ['customer_id' => $report->customer->getKey(), 'taxonomy_id' => $taxonomy_id];
        $data = $service->generate($report->survey, $attributes);
        dd($data);

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
