<?php

namespace Customer\Http\Controllers\Api\Crm;

use Core\Http\Controllers\Api\ApiController;
use Customer\Services\CustomerServiceInterface;
use Illuminate\Http\Request;

class SaveFoundCustomerFromCrm extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request                    $request
     * @param  \Customer\Services\CustomerServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, CustomerServiceInterface $service)
    {
        return response()->json($service->saveFromCrm($request->all()));
    }
}
