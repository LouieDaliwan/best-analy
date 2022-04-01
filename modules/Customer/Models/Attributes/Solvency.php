<?php

namespace Customer\Models\Attributes;

class Solvency {

    public static function compute($solvency, $balanceSheets)
    {
        $solvency['debt_to_equity_ratio'] = (float) $balanceSheets['stockholdersequity'] != 0  ?
        round( ((float) $balanceSheets['total_liabilities'] / (float) $balanceSheets['stockholdersequity']), 2) : 0;

        $solvency['debt_ratio'] = (float) $balanceSheets['total_assets'] != 0 ? round(
                ((float) $balanceSheets['total_liabilities'] / (float) $balanceSheets['total_assets']), 2
            ) 
            : 0;

        return $solvency;
    }
}