<?php

namespace Best\Http\Controllers\Api;

use Best\Services\ReportServiceInterface;
use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class GetReportsMonths extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request              $request
     * @param  \Best\Services\ReportServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ReportServiceInterface $service)
    {
        return response()->json($service->getMonths());
    }
}
