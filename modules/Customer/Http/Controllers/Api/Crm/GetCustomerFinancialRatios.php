<?php

namespace Customer\Http\Controllers\Api\Crm;

use Core\Http\Controllers\Api\ApiController;
use Customer\Services\CustomerServiceInterface;
use Customer\Support\Crm\FileNumber;
use Illuminate\Http\Request;

class GetCustomerFinancialRatios extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Customer\Support\Crm\FileNumber            $fileNumber
     * @param  \Customer\Services\CustomerServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(FileNumber $fileNumber, CustomerServiceInterface $service)
    {
        return response()->json($service->where('refnum', $fileNumber)->first()->getMetadataForCrm());
    }
}
