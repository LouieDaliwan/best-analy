<?php

namespace Customer\Models\Attributes;

class Efficiency
{
    protected $customer;

    protected $statements;

    public function __construct($customer)
    {
        $this->customer = $customer;

        $this->statements = $this->customer
        ->statements()
        ->latest('period')
        ->take(3)
        ->get()
        ->toArray();
    }

    public function compute() : void
    {
        $this->computePeriodOneAndTwo();

        $this->computePeriodTwoAndThree();
    }

    protected function computePeriodOneAndTwo()
    {
        $period1 = $this->statements[0];
        $period2 = $this->statements[1];

    }

    protected function computePeriodTwoAndThree()
    {

    }

    protected function save($customerDetails)
    {
        $this->customer->statematents()->updateOrCreate([
            'customer_id' => $this->customer->id,
            'period' => $customerDetails['period']
        ],
        [
            'metadataResults' => []
        ]
        );
    }
}
