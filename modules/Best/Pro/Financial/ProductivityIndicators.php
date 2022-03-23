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
        $spreadsheet = self::getReport($customer);

        // Set Customer Data.
        $spreadsheet->getSheetByName('Customer')->setCellValue('B2', $customer->name);
        $spreadsheet->getSheetByName('Customer')->setCellValue('B3', $customer->refnum);
        $spreadsheet->getSheetByName('Customer')->setCellValue('B4', $customer->metadata['staffstrength'] ?? 0);
        $spreadsheet->getSheetByName('Customer')->setCellValue('B5', $customer->metadata['industry'] ?? null);

        $spreadsheet = $spreadsheet->getSheetByName('ProductivityIndicators');

        return [
            'summary' => self::getSummary($financialStatements),
            'detail' => self::getDetail($financialStatements),
            // 'detail' => $spreadsheet->rangeToArray('B14:F42'),
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
