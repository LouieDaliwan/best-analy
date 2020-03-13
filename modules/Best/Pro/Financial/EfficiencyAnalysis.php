<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;

abstract class EfficiencyAnalysis extends AbstractAnalysis
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
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H42:W42')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    // Year 1.
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('D43')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H43:W43')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#6751bd', '#6751bd'],
                    ],
                    // Year 2.
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('D44')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H44:W44')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#ed4886', '#ed4886'],
                    ],
                    // Year 3.
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('D45')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H45:W45')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#6299dd', '#6299dd'],
                    ],
                ],
            ],

            'comments' => [
                explode(
                    '||', $spreadsheet
                        ->getSheetByName('FinancialAnalysisReport')
                        ->getCell('BF17')
                        ->getCalculatedValue()
                ),
                explode(
                    '||', $spreadsheet
                        ->getSheetByName('FinancialAnalysisReport')
                        ->getCell('BF18')
                        ->getCalculatedValue()
                ),
                explode(
                    '||', $spreadsheet
                        ->getSheetByName('FinancialAnalysisReport')
                        ->getCell('BF19')
                        ->getCalculatedValue()
                ),
                explode(
                    '||', $spreadsheet
                        ->getSheetByName('FinancialAnalysisReport')
                        ->getCell('BF20')
                        ->getCalculatedValue()
                ),
            ],
        ];
    }
}
