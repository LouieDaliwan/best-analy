<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;
use Best\Pro\Financial\Data\Efficiency;
use Best\Pro\Financial\Data\LiquidityData;
use Best\Pro\Financial\Data\EfficiencyData;
use Best\Pro\Financial\Data\ProfitabilityData;
use Best\Pro\Financial\Data\SolvencyData;

abstract class FinancialRatios extends AbstractAnalysis
{
    const PROFITABILITY = 'PROFITABILITY';
    const LIQUIDITY = 'LIQUIDITY';
    const EFFICIENCY = 'EFFICIENCY';
    const SOLVENCY = 'SOLVENCY';
    const ADDITIONAL = 'ADDITIONAL RATIOS';
    /**
     * Retrieve the report.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public static function getReport(Customer $customer, $financialStatements)
    {

        $spreadsheet = self::getSpreadsheet($customer)->getSheetByName('FS_inputs');

        $years = self::getYears($financialStatements);

        $spreadsheet = self::getSpreadsheet($customer)->getSheetByName('Ratios');

        $profitabilityTitle = self::PROFITABILITY;
        $liquidityTitle = self::LIQUIDITY;
        $efficiencyTitle = self::EFFICIENCY;
        $solvencyTitle = self::SOLVENCY;
        $additionalTitle = self::ADDITIONAL;

        return [
            '' => [$years],
            // $profitabilityTitle => $spreadsheet->rangeToArray('B3:E36'),
            $profitabilityTitle => self::profitabilityData($financialStatements),
            // $liquidityTitle => $spreadsheet->rangeToArray('B39:E59'),
            $liquidityTitle => self::liquidityData($financialStatements),
            // $efficiencyTitle => $spreadsheet->rangeToArray('B61:E83'),
            $efficiencyTitle => self::efficiencyData($financialStatements),
            // $solvencyTitle => $spreadsheet->rangeToArray('B85:E93'),
            $solvencyTitle => self::solvencyData($financialStatements),
            // $additionalTitle => self,
        ];
    }

    protected static function getYears($financialStatements)
    {
        $years = [null];

        foreach($financialStatements as $financialStatement)
        {
            array_push($years, $financialStatement['period']);
        }

        return $years;
    }

    protected static function profitabilityData($financialStatements)
    {
        $profitibalityData = new ProfitabilityData($financialStatements);

        return $profitibalityData->getData();
    }

    protected static function liquidityData($financialStatements)
    {
        $liquidityData = new LiquidityData($financialStatements);

        return $liquidityData->getData();
    }

    protected static function efficiencyData($financialStatements)
    {
        $efficiencyData = new EfficiencyData($financialStatements);

        return $efficiencyData->getData();
    }

    protected static function solvencyData($financialStatements)
    {
        $solvencyData = new SolvencyData($financialStatements);

        return $solvencyData->getData();
    }
}
