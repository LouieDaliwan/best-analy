<?php

namespace Best\Http\Controllers\Api;

use Best\Models\Report;
use Best\Services\ReportServiceInterface;
use Core\Http\Controllers\Api\ApiController;
use Customer\Models\Customer;
use Illuminate\Http\Request;

class GetPerformanceIndexReport extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Best\Models\Report      $report
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Report $report)
    {
        return view('best::reports.index')->withData(array_merge(
            $report->value,
            ['current:pindex' => $report->value['current:index'] ?? []]
        ));
    }
}