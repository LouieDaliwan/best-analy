<?php

namespace Best\Http\Controllers\Api;

use Best\Models\Report;
use Best\Services\FormulaServiceInterface;
use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class DownloadPerformanceIndexReport extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request               $request
     * @param  \Best\Models\Report                    $report
     * @param  \Best\Services\FormulaServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Report $report, FormulaServiceInterface $service)
    {
        return $service->download($report);
    }
}
