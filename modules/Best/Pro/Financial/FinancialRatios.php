<?php

namespace Best\Pro\Financial;

abstract class FinancialRatios extends AbstractAnalysis
{
    /**
     * Retrieve the report.
     *
     * @return array
     */
    public static function getReport()
    {
        $spreadsheet = self::getSpreadsheet()->getSheetByName('Ratios');

        $profitabilityTitle = $spreadsheet->getCell('A2')->getFormattedValue();
        $liquidityTitle = $spreadsheet->getCell('A39')->getFormattedValue();
        $efficiencyTitle = $spreadsheet->getCell('A61')->getFormattedValue();
        $solvencyTitle = $spreadsheet->getCell('A85')->getFormattedValue();
        $productivityTitle = $spreadsheet->getCell('A95')->getFormattedValue();

        return [
            '' => [[null, 'Year 1', 'Year 2', 'Year 3 (most recent)']],
            $profitabilityTitle => $spreadsheet->rangeToArray('B3:E36'),
            $liquidityTitle => $spreadsheet->rangeToArray('B39:E59'),
            $efficiencyTitle => $spreadsheet->rangeToArray('B61:E83'),
            $solvencyTitle => $spreadsheet->rangeToArray('B85:E93'),
            $productivityTitle => $spreadsheet->rangeToArray('B95:E98'),
        ];
    }
}
