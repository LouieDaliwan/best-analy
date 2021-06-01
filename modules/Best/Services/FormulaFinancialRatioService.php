<?php

namespace Best\Services;

use Best\Services\FormulaFinancialRatioInterface;

class FormulaFinancialRatioService implements FormulaFinancialRatioInterface
{
    public $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function generateRatio()
    {

    }
}
