<?php

namespace Best\Pro\Financial;

abstract class EfficiencyAnalysis extends AbstractAnalysis
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
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H42:W42')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('D43')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H43:W43')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 1)',
                    ],
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('D44')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H44:W44')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 0.8)',
                    ],
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('D45')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H45:W45')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->values()->toArray(),
                        'backgroundColor' => 'rgba(22, 123, 195, 0.5)',
                    ],
                ],
            ],

            'comments' => [
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF17')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF18')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF19')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF20')->getCalculatedValue(),
            ],
        ];
    }
}
