<?php

namespace Customer\Http\Controllers\Api;

use Best\Services\ReportServiceInterface;
use Core\Http\Controllers\Api\ApiController;
use Customer\Http\Resources\ReportResource;
use Customer\Models\Customer;
use Customer\Services\CustomerServiceInterface;
use Illuminate\Http\Request;

class GetCustomerReportsList extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Customer\Models\Customer                   $customer
     * @param  \Customer\Services\CustomerServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Customer $customer, CustomerServiceInterface $service)
    {
        return ReportResource::collection($service->listReports($customer));
    }
}
