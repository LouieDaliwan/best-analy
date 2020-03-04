<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

abstract class ProfitabilityAnalysis extends AbstractAnalysis
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
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H18:Y18')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    // Year 1.
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('D19')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H19:Y19')
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
                            ->getCell('D20')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H20:Y20')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return $cell;
                        })->values()->toArray(),
                        'backgroundColor' => ['#00c6fb', '#005bea'],
                    ],
                    // Year 3.
                    [
                        'label' => $spreadsheet->getSheetByName('FinancialAnalysisReport')
                            ->getCell('D21')->getCalculatedValue(),
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H21:Y21')
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
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF4')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF5')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF6')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF7')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF8')->getCalculatedValue(),
                $spreadsheet->getSheetByName('FinancialAnalysisReport')->getCell('BF9')->getCalculatedValue(),
            ],
        ];
    }
}
