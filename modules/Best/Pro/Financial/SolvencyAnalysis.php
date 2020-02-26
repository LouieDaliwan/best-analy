<?php

namespace Best\Pro\Financial;

abstract class SolvencyAnalysis extends AbstractAnalysis
{
    /**
     * Retrieve the report.
     *
     * @return array
     */
    public static function getReport()
    {
        $spreadsheet = self::getSpreadsheet();

        return [
            'charts' => [
                'labels' => collect(
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AE43:AE45')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE43')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI43:AR43')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 1)',
                    ],
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE44')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI44:AR44')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 0.8)',
                    ],
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE45')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI45:AR45')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 0.5)',
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
