<?php

use Best\Models\Report;
use Best\Services\FormulaServiceInterface;
use Best\Services\ReportServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;
use Survey\Models\Survey;
use User\Models\User;

Route::post('best/login/microsoft', 'Api\Ldap\LoginController@login');

Route::post('reports/{report}/download', 'Api\DownloadPerformanceIndexReport');
Route::post('reports/download', 'Api\DownloadPerformanceIndexReport')->name('reports.download');

// Using this on frontend.
Route::get('best/reports/{report}/pdf', 'Api\GetPerformanceIndexPdfReport')->name('reports.show');
Route::get('best/reports/{report}', 'Api\GetPerformanceIndexReport')->name('reports.show');
Route::get('best/reports/ratios/{report}', 'Api\GetPerformanceIndexReport');

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
    app()->setLocale($request->get('lang') ?: 'en');

    $file = $request->get('month') ?: date('m-Y');
    $customerId = $request->get('customer_id');
    $user = User::find($request->get('user_id'));
    Auth::login($user);

    $report = Report::where('month', $file)
        ->whereCustomerId($customerId)
        ->whereUserId($user->getKey())
        ->latest()->first();

    $attributes = [
        'customer_id' => $customerId,
        'month' => $report->remarks ?? date('Y-m-d H:i:s'),
    ];

    $survey = \Survey\Models\Survey::find($request->get('survey_id') ?: 1);
    $data = $service->generate($survey, $attributes);
    $data['month:formatted'] = date('M d, Y', strtotime($data['month'] ?? date('Y-m-d')));
    $data['current:pindex']['sitevisit:date:formatted'] = date('M d, Y', strtotime($data['month']));

    return view("best::reports.overall")->withData($data);
});

Route::get('best/preview/reports/ratios', function (Request $request, FormulaServiceInterface $service) {
    app()->setLocale($request->get('lang') ?: 'en');

    $file = $request->get('month') ?: date('m-Y');
    $customerId = $request->get('customer_id');
    $user = User::find($request->get('user_id'));
    Auth::login($user);

    $report = Report::where('month', $file)
        ->whereCustomerId($customerId)
        ->whereUserId($user->getKey())
        ->latest()->first();

    $attributes = [
        'customer_id' => $request->get('customer_id'),
        'month' => $report->remarks ?? date('Y-m-d H:i:s'),
    ];
    $survey = \Survey\Models\Survey::find($request->get('survey_id') ?: 1);
    $data = $service->generate($survey, $attributes);
    $data['month:formatted'] = date('M d, Y', strtotime($data['month'] ?? date('Y-m-d')));
    $data['current:pindex']['sitevisit:date:formatted'] = date('M d, Y', strtotime($data['month']));

    return view("best::reports.financialratio")->withData($data);
});

Route::get(
    'best/preview/reports/{report}',
    function (Request $request, Report $report, FormulaServiceInterface $service) {
        app()->setLocale($request->get('lang') ?: 'en');

        $file = $request->get('type') ?: 'index';
        $taxonomy_id = $request->get('taxonomy_id');

        Auth::login($report->user);

        $attributes = [
            'customer_id' => $report->customer->getKey(),
            'taxonomy_id' => $taxonomy_id,
            'month' => $report->remarks,
        ];
        $data = $service->generate($report->survey, $attributes);
        $data['month:formatted'] = date('M d, Y', strtotime($data['month'] ?? date('Y-m-d')));
        $data['current:pindex']['sitevisit:date:formatted'] = date('M d, Y', strtotime($data['month']));

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

Route::get('best/dompdf', function (Request $request, FormulaServiceInterface $service) {
    app()->setLocale($request->get('lang') ?: 'en');

    $file = $request->get('type') ?: 'index';

    $taxonomy_id = $request->get('taxonomy_id');

    if (is_null($request->get('report_id'))) {
        return null;
    }

    $report = \Best\Models\Report::find($request->get('report_id'));

    Auth::login($report->user);

    $attributes = ['customer_id' => $report->customer->getKey(), 'taxonomy_id' => $taxonomy_id];
    $data = $service->generate($report->survey, $attributes);

    $type = $request->get('type') ?: 'index';

    $pdf = \Barryvdh\Snappy\Facades\SnappyPdf::loadHTML(view("best::reports.pdf.$type")->withData($data));

    if ($request->get('view') == 'blade') {
        return view("best::reports.pdf.$type")->withData($data);
    }

    try {
        return $pdf
            ->setPaper('legal')
            ->setOption('enable-javascript', true)
            ->setOption('debug-javascript', true)
            ->stream('dom.pdf');
    } catch (\Exception $e) {
        Log::info('error -->', $e->getMessage());
    }
});

Route::get('best/reports/pdf/preview', 'Report\PreviewPdfReport');
Route::get('best/reports/pdf/preview/overall', 'Report\PreviewOverallPdfReport');

Route::get('@run/system/command', function () {
    $command = "C:\\laragon\\www\\best\\vendor\\bin\\wkhtmltopdf.exe.bat";
    $url = url('best/reports/pdf/preview/overall').'?user=41&customer=19&month=07-2020&lang=en&view=blade&prefix=41';
    $path = storage_path('modules/sample.pdf');
    exec("$command --page-size legal --javascript-delay 3000 '$url' $path");
    exit;
});
