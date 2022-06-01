<?php

namespace Customer\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Customer\Http\Controllers\Controller;
use Customer\Models\Customer;
use Customer\Services\CustomerServiceInterface;

class CustomerSdmiController extends ApiController {
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Customer $customer, CustomerServiceInterface $service)
    {
        return $service->getSdmiScore($customer);
    }
}
