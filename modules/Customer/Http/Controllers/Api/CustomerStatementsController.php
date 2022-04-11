<?php

namespace Customer\Http\Controllers\Api;


use Core\Http\Controllers\Api\ApiController;
use Customer\Models\Customer;
use Customer\Models\FinancialStatement;
use Customer\Services\CustomerServiceInterface;
use Illuminate\Http\Request;

class CustomerStatementsController extends ApiController
{
    public $service;


    public function __construct(CustomerServiceInterface $service)
    {
        $this->service = $service;
    }

    public function destroy($customer, $ratio)
    {
        $financialStatement = FinancialStatement::findOrFail($ratio);

        try {
            $financialStatement->delete();
        } catch(\Exception $e) {
            return $e->getMessage();
        }

        return true;
    }
}
