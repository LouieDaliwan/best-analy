<?php

namespace Best\Pro\Financial;

abstract class LiquidityAnalysis extends AbstractAnalysis
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
            'chart' => [
                'labels' => collect(
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI18:AU18')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE19')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI19:AU19')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 1)',
                    ],

                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE20')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI20:AU20')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 0.8)',
                    ],

                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('AE21')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI21:AU21')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 0.5)',
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
