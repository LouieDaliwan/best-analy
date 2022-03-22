<?php

namespace Best\Pro\Financial;

use Best\Pro\Financial\Data\ProductivitySummary;
use Customer\Models\Customer;

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
        $spreadsheet = self::getReport($customer);

        // Set Customer Data.
        $spreadsheet->getSheetByName('Customer')->setCellValue('B2', $customer->name);
        $spreadsheet->getSheetByName('Customer')->setCellValue('B3', $customer->refnum);
        $spreadsheet->getSheetByName('Customer')->setCellValue('B4', $customer->metadata['staffstrength'] ?? 0);
        $spreadsheet->getSheetByName('Customer')->setCellValue('B5', $customer->metadata['industry'] ?? null);

        $spreadsheet = $spreadsheet->getSheetByName('ProductivityIndicators');

        return [
            'summary' => self::getSummary($financialStatements),
            'detail' => $spreadsheet->rangeToArray('B14:F42'),
        ];
    }

    protected static function getSummary($financialStatements)
    {
        $summary = new ProductivitySummary($financialStatements);

        return $summary->getSummary();
    }
}
