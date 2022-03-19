<?php

namespace Best\Pro\Financial\Contracts;

use Customer\Models\Customer;

interface FinancialAnalysisReportInterface
{
    /**
     * Generate the report.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    // public static function getReport(Customer $customer);
}
