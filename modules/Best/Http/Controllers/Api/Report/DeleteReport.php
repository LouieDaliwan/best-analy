<?php

namespace Best\Http\Controllers\Api\Report;

use Best\Models\Report;
use Best\Services\ReportServiceInterface;
use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class DeleteReport extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request              $request
     * @param  integer                               $id
     * @param  \Best\Services\ReportServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id, ReportServiceInterface $service)
    {
        return response()->json($service->delete($request->has('id') ? $request->input('id') : $id));
    }
}
