<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;

abstract class LiquidityAnalysis extends AbstractAnalysis
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
            'chart' => [
                'labels' => collect(
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI18:AU18')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    // Year 1.
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE19')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI19:AU19')
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
                            ->getCell('AE20')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI20:AU20')
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
                            ->getCell('AE21')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI21:AU21')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#21D4FD', '#B721FF'],
                    ],
                ],
            ],

            'comment' => [
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF12')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF13')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF14')->getCalculatedValue(),
            ],
        ];
    }
}
