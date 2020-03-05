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

// Route get best/reports/overall, 'Api\GetOverallReport name reports.overall.
Route::get('best/test/browsershot/{report}', function (Report $report) {
    return view('best::reports.pdf')->withData(array_merge(
        $report->value,
        ['current:pindex' => $report->value['current:index'] ?? []]
    ));
});

Route::get('best/test/browsershot', function () {
    $service = app(\Best\Services\FormulaServiceInterface::class);
    $report = \Best\Models\Report::find(1);

    header('Content-Type: application/pdf');
    header('Content-disposition: attachment; filename="output.pdf"');
    header('Cache-Control: public, must-revalidate, max-age=0');

    return $service->download($report);
});

Route::get('best/data', function () {
    $report = app(FormulaServiceInterface::class);
    Auth::login(User::find(41));
    $data = $report->generate(Survey::find(1), [
        'taxonomy_id' => 1, 'customer_id' => 1
    ]);

    dd($data);
});

Route::get('best/test/overall/dd', function () {
    $report = app(\Best\Services\ReportServiceInterface::class);
    \Illuminate\Support\Facades\Auth::login(\User\Models\User::find(41));
    $data = $report->generate(\Survey\Models\Survey::find(1), ['customer_id' => 1]);

    dd($data);
});

Route::get('best/test/overall', function () {
    $report = app(\Best\Services\ReportServiceInterface::class);
    \Illuminate\Support\Facades\Auth::login(\User\Models\User::find(41));
    $data = $report->generate(\Survey\Models\Survey::find(1), ['taxonomy_id' => 1, 'customer_id' => 1]);
    return view('best::reports.overall')->withData($data);
});

Route::get('best/preview', function () {
    $report = app(\Best\Services\FormulaServiceInterface::class);
    \Illuminate\Support\Facades\Auth::login(\User\Models\User::find(41));
    $data = $report->generate(\Survey\Models\Survey::find(1), ['taxonomy_id' => 1, 'customer_id' => 1]);
    return view('best::reports.pdf')
        ->withData(array_merge(
            $data,
            ['current:pindex' => $data['indices']['FMPI']]
        ));
});

Route::get('best/test/phantom', function () {
    $service = app(\Best\Services\FormulaServiceInterface::class);
    $report = \Best\Models\Report::find(1);

    $html = view('best::reports.pdf')->withData(array_merge(
        $report->value,
        ['current:pindex' => $report->value['current:index'] ?? []]
    ))->render();

    $c = new \Anam\PhantomMagick\Converter;
    $c->setBinary(base_path('bin/phantomjs'));
    $c->addPage($html)
      ->format('A4')
      ->setPdfOptions(['margin' => '5mm'])
      ->toPdf();

    return $c->serve();
});

Route::get('best/test/sheet', function () {
    $spreadsheet = \Best\Pro\Financial\EfficiencyAnalysis::getSpreadsheet();

    $data = \Best\Pro\Financial\FinancialRatios::getReport();
    return view('best::tests.sheet')->withData($data);
});

Route::get('x/x', function () {
    $s = Survey\Models\Survey::find(4);
    Auth::login($user = User\Models\User::find(41));
    header('Content-Type: application/pdf');
    header('Content-disposition: attachment; filename="output.pdf"');
    header('Cache-Control: public, must-revalidate, max-age=0');

    return Browsershot::html($service->download($data))->pdf();
});
