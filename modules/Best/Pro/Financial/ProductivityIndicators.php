<?php

namespace Best\Pro\Financial;

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
    public static function getReportWithCustomer($customer)
    {
        $spreadsheet = self::getReport($customer);

        // Set Customer Data.
        $spreadsheet->getSheetByName('Customer')->setCellValue('B2', $customer->name);
        $spreadsheet->getSheetByName('Customer')->setCellValue('B3', $customer->refnum);
        $spreadsheet->getSheetByName('Customer')->setCellValue('B4', $customer->metadata['staffstrength'] ?? 0);
        $spreadsheet->getSheetByName('Customer')->setCellValue('B5', $customer->metadata['industry'] ?? null);

        $spreadsheet = $spreadsheet->getSheetByName('ProductivityIndicators');

        return [
            'summary' => $spreadsheet->rangeToArray('B4:F12'),
            'detail' => $spreadsheet->rangeToArray('B14:F42'),
        ];
    }
}
