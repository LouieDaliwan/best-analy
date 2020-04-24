<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;

abstract class ProfitAndLossStatement extends AbstractAnalysis
{
    /**
     * Retrieve the report.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public static function getReport(Customer $customer)
    {
        $spreadsheet = self::getSpreadsheet($customer)->getSheetByName('Profit&Loss');

        return [
            'Revenue' => [
                'Year1' => $spreadsheet->getCell('C4')->getCalculatedValue(),
                'Year2' => $spreadsheet->getCell('D4')->getCalculatedValue(),
                'Year3' => $spreadsheet->getCell('E4')->getCalculatedValue(),
            ],
            'CostOfGoodsSold' => [
                'Year1' => $spreadsheet->getCell('C5')->getCalculatedValue(),
                'Year2' => $spreadsheet->getCell('D5')->getCalculatedValue(),
                'Year3' => $spreadsheet->getCell('E5')->getCalculatedValue(),
            ],
            'OtherExpenses' => [
                'Operating expenses (OE)' => [
                    'Year1x' => $spreadsheet->getCell('C6')->getCalculatedValue(),
                    'Year2' => $spreadsheet->getCell('D6')->getCalculatedValue(),
                    'Year3' => $spreadsheet->getCell('E6')->getCalculatedValue(),
                ],
                'Non-Operating expenses (NOE)' => [
                    'Year1' => $spreadsheet->getCell('C7')->getCalculatedValue(),
                    'Year2' => $spreadsheet->getCell('D7')->getCalculatedValue(),
                    'Year3' => $spreadsheet->getCell('E7')->getCalculatedValue(),
                ],
                'Operating (loss)/profit' => [
                    'Year1' => $spreadsheet->getCell('C8')->getCalculatedValue(),
                    'Year2' => $spreadsheet->getCell('D8')->getCalculatedValue(),
                    'Year3' => $spreadsheet->getCell('E8')->getCalculatedValue(),
                ],
                'Depreciation' => [
                    'Year1' => $spreadsheet->getCell('C9')->getCalculatedValue(),
                    'Year2' => $spreadsheet->getCell('D9')->getCalculatedValue(),
                    'Year3' => $spreadsheet->getCell('E9')->getCalculatedValue(),
                ],
                'Taxes' => [
                    'Year1' => $spreadsheet->getCell('C10')->getCalculatedValue(),
                    'Year2' => $spreadsheet->getCell('D10')->getCalculatedValue(),
                    'Year3' => $spreadsheet->getCell('E10')->getCalculatedValue(),
                ],
            ],
            'NetProfit' => [
                'Year1' => $spreadsheet->getCell('C11')->getCalculatedValue(),
                'Year2' => $spreadsheet->getCell('D11')->getCalculatedValue(),
                'Year3' => $spreadsheet->getCell('E11')->getCalculatedValue(),
            ],
            'FixedAssets' => [
                "Fixed Assets" => $customer->metadata['balance-sheet']['Fixed Assets'] ?? [],
                "Total Liabilities" => [
                    'Year1' => $spreadsheet->getCell('C21')->getCalculatedValue(),
                    'Year2' => $spreadsheet->getCell('D21')->getCalculatedValue(),
                    'Year3' => $spreadsheet->getCell('E21')->getCalculatedValue(),
                ],
                "Stockholders' Equity" => $customer->metadata['balance-sheet']["Stockholders' Equity"] ?? [],
            ],
            "Marketing" => [
                'Year1' => $spreadsheet->getCell('AC39')->getCalculatedValue(),
                'Year2' => $spreadsheet->getCell('AI39')->getCalculatedValue(),
                'Year3' => $spreadsheet->getCell('AO39')->getCalculatedValue(),
            ],
            "Rent" => [
                'Year1' => $spreadsheet->getCell('AC35')->getCalculatedValue(),
                'Year2' => $spreadsheet->getCell('AI35')->getCalculatedValue(),
                'Year3' => $spreadsheet->getCell('AO35')->getCalculatedValue(),
            ],
            "Salaries" => [
                'Year1' => $spreadsheet->getCell('AC69')->getCalculatedValue(),
                'Year2' => $spreadsheet->getCell('AI69')->getCalculatedValue(),
                'Year3' => $spreadsheet->getCell('AO69')->getCalculatedValue(),
            ],
            "Licensing Fees" => [
                'Year1' => $spreadsheet->getCell('AC48')->getCalculatedValue(),
                'Year2' => $spreadsheet->getCell('AI48')->getCalculatedValue(),
                'Year3' => $spreadsheet->getCell('AO48')->getCalculatedValue(),
            ],
            "Visa / Employment Fees" => [
                'Year1' => $spreadsheet->getCell('AC93')->getCalculatedValue(),
                'Year2' => $spreadsheet->getCell('AI93')->getCalculatedValue(),
                'Year3' => $spreadsheet->getCell('AO93')->getCalculatedValue(),
            ],
            "Year of Financial" => [
                'Year1' => $spreadsheet->getCell('AC8')->getCalculatedValue(),
                'Year2' => $spreadsheet->getCell('AI8')->getCalculatedValue(),
                'Year3' => $spreadsheet->getCell('AO8')->getCalculatedValue(),
            ],
            "Submission Date" => $customer->metadata['SiteVisitDate'] ?? null,
        ];
    }
}
