<?php

use Anam\PhantomMagick\Converter;
use Customer\Models\Customer;
use Index\Models\Index;

Route::post('reports/download', 'Api\DownloadPerformanceIndexReport')->name('reports.download');

Route::get('best/email', function () {
    $report = app(\Best\Services\ReportServiceInterface::class);

    \Illuminate\Support\Facades\Auth::login(\User\Models\User::find(1));
    $data = $report->generate(\Survey\Models\Survey::find(1), ['customer_id' => 1]);

    return view('best::email.index')
        ->withData(array_merge(
            ['analysis:financial' => $data['analysis:financial']],
            $data['indices']['FMPI'],
        ));
});

Route::get('best/data', function () {
    $report = app(\Best\Services\ReportServiceInterface::class);

    \Illuminate\Support\Facades\Auth::login(\User\Models\User::find(1));
    $data = $report->generate(\Survey\Models\Survey::find(1), ['customer_id' => 1]);

    dd(array_merge(
        ['analysis:financial' => $data['analysis:financial']],
        $data['indices']['FMPI'],
    ));
});

Route::get('best/test/overall/dd', function () {
    $report = app(\Best\Services\ReportServiceInterface::class);
    \Illuminate\Support\Facades\Auth::login(\User\Models\User::find(1));
    $data = $report->generate(\Survey\Models\Survey::find(1), ['customer_id' => 1]);

    dd($data);
});

Route::get('best/test/overall', function () {
    $report = app(\Best\Services\ReportServiceInterface::class);
    \Illuminate\Support\Facades\Auth::login(\User\Models\User::find(1));
    $data = $report->generate(\Survey\Models\Survey::find(1), ['customer_id' => 1]);
    return view('best::reports.index')->withData($data);
});

Route::get('best/test', function () {
    $report = app(\Best\Services\ReportServiceInterface::class);
    \Illuminate\Support\Facades\Auth::login(\User\Models\User::find(1));
    $data = $report->generate(\Survey\Models\Survey::find(1), ['customer_id' => 1]);
    return view('best::reports.index')
        ->withData(array_merge(
            ['analysis:financial' => $data['analysis:financial']],
            ['indicators:productivity' => $data['indicators:productivity']],
            $data['indices']['FMPI'],
        ));
});

Route::get('best/test/phantom', function () {
    $report = app(\Best\Services\ReportServiceInterface::class);
    \Illuminate\Support\Facades\Auth::login(\User\Models\User::find(1));
    $data = $report->generate(\Survey\Models\Survey::find(1), ['customer_id' => 1]);

    $c = new Converter;
    $c->setBinary(base_path('bin/phantomjs'));
    $c->addPage(view('best::reports.index')
        ->withData(array_merge(
            ['analysis:financial' => $data['analysis:financial']],
            ['indicators:productivity' => $data['indicators:productivity']],
            $data['indices']['FMPI'],
        ))->render())
      ->format('Legal')
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

    return dd($s->submission);
});
