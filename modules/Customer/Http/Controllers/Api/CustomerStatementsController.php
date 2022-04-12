<?php

namespace Customer\Http\Controllers\Api;


use Core\Http\Controllers\Api\ApiController;
use Customer\Models\Attributes\Efficiency;
use Customer\Models\Customer;
use Customer\Models\FinancialStatement;
class CustomerStatementsController extends ApiController
{
    public function destroy($customer, $ratio)
    {
        $financialStatement = FinancialStatement::findOrFail($ratio);
        
        $customer = Customer::findOrFail($customer);        

        try {            
            $period  = $financialStatement->period;

            $financialStatement->delete();

            $this->checkFollowPeriod($period, $customer);         

        } catch(\Exception $e) {
            return $e->getMessage();
        }

        return json_encode(['data' => 'true']);
    }

    protected function checkFollowPeriod($period, $customer)
    {
        $period = (int) $period;
     
        foreach ($customer->statements as $statement) {
            
            if ((int) $statement->period == (int) $period) {

                $efficiency = new Efficiency($customer, $statement->period);

                $efficiency->compute();

                break;
            }
            
            $period++;
        }
    }
}