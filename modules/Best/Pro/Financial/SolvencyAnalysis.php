<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;

abstract class SolvencyAnalysis extends AbstractAnalysis
{
    /**
     * Retrieve the report.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public static function getReport(Customer $customer)
    {
        $spreadsheet = self::getSpreadsheet($customer);

        return [
            'charts' => [
                'labels' => collect(
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI42:AN42')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    // Year 1.
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE43')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI43:AR43')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#2AF598', '#08AEEA'],
                    ],
                    // Year 2.
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE44')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI44:AR44')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#00c6fb', '#005bea'],
                    ],
                    // Year 3.
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE45')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI45:AR45')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#21D4FD', '#B721FF'],
                    ],
                ],
            ],

            'comments' => [
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF24')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF25')->getCalculatedValue(),
            ],
        ];
    }
}
