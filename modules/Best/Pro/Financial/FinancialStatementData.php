<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;

abstract class FinancialStatementData extends AbstractAnalysis
{
    /**
     * Retrieve the report.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public static function getReport(Customer $customer)
    {
        $spreadsheet = self::getSpreadsheet($customer)->getSheetByName('FS_inputs');
        $years = [
            null,
            $spreadsheet->getCell('AC8')->getFormattedValue() ?? 'Year 1',
            $spreadsheet->getCell('AI8')->getFormattedValue() ?? 'Year 2',
            $spreadsheet->getCell('AO8')->getFormattedValue() ?? 'Year 3 (most recent)',
        ];

        $spreadsheet = self::getSpreadsheet($customer)->getSheetByName('Ratios');

        $profitabilityTitle = $spreadsheet->getCell('A2')->getFormattedValue();
        $liquidityTitle = $spreadsheet->getCell('A39')->getFormattedValue();
        $efficiencyTitle = $spreadsheet->getCell('A61')->getFormattedValue();
        $solvencyTitle = $spreadsheet->getCell('A85')->getFormattedValue();

        return [
            '' => [$years],
            $profitabilityTitle => $spreadsheet->rangeToArray('B3:E36'),
            $liquidityTitle => $spreadsheet->rangeToArray('B39:E59'),
            $efficiencyTitle => $spreadsheet->rangeToArray('B61:E83'),
            $solvencyTitle => $spreadsheet->rangeToArray('B85:E93'),
        ];
    }
}
