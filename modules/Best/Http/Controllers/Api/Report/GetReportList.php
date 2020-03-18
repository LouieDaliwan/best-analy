<?php

namespace Best\Http\Controllers\Api\Report;

use Best\Services\ReportServiceInterface;
use Core\Http\Controllers\Api\ApiController;
use Customer\Http\Resources\ReportResource;

class GetReportList extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Best\Services\ReportServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ReportServiceInterface $service)
    {
        return ReportResource::collection($service->list());
    }
}
