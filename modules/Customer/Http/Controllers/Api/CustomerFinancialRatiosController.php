<?php

namespace Customer\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Http\Controllers\Api\ApiController;
use Customer\Models\Customer;
use Customer\Services\CustomerServiceInterface;

class CustomerFinancialRatiosController extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Customer $customer, CustomerServiceInterface $service)
    {
        dd($customer);
        return $service->financialRatios($customer);
    }
}
