<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;
use Best\Pro\Financial\Data\ProductivityDetail;
use Best\Pro\Financial\Data\ProductivitySummary;

abstract class ProductivityIndicators extends AbstractAnalysis
{
    /**
     * Retrieve the report.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public static function getReport(Customer $customer)
    {
        return self::getSpreadsheet($customer);
    }

    /**
     * Retrieve the spreadsheet data.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public static function getReportWithCustomer($customer, $financialStatements)
    {
        return [
            'summary' => self::getSummary($financialStatements),
            'detail' => self::getDetail($financialStatements),
        ];
    }

    protected static function getSummary($financialStatements)
    {
        $summary = new ProductivitySummary($financialStatements);

        return $summary->getSummary();
    }

    protected static function getDetail($financialStatements)
    {
        $detail = new ProductivityDetail($financialStatements);

        return $detail->getData();
    }
}
