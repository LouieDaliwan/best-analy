<?php

namespace Best\Services;

use Core\Application\Service\ServiceInterface;
use Customer\Models\Customer;
use User\Models\User;

interface FormulaFinancialRatioInterface extends ServiceInterface
{
     /**
      * Create a contracts that needs this method when implement this class
      *
      * @author Louie Daliwan
      */
    public function generateRatio(Customer $customer, User $user);
}
