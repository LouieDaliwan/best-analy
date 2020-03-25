<?php

namespace Best\Http\Controllers\Api;

use Best\Services\ReportServiceInterface;
use Core\Http\Controllers\Api\ApiController;
use Customer\Http\Resources\ReportResource;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use User\Models\User;

class GetUserCustomerReportsList extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request              $request
     * @param  \Customer\Models\Customer             $customer
     * @param  \User\Models\User                     $user
     * @param  \Best\Services\ReportServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Customer $customer, User $user, ReportServiceInterface $service)
    {
        return ReportResource::collection($service->onlyFromUser($user, $customer));
    }
}