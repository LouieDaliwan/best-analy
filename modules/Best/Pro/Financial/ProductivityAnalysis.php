<?php

namespace Best\Pro\Financial;

abstract class ProductivityAnalysis extends AbstractAnalysis
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
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI68:AI68')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE69')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI69:AI69')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 1)',
                    ],
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE70')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI70:AI70')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 0.8)',
                    ],
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE71')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI71:AI71')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 0.5)',
                    ],
                ],
            ],

            'comments' => [
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF30')->getCalculatedValue(),
            ],
        ];
    }
}
