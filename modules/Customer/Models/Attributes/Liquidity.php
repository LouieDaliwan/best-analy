<?php

namespace Customer\Models\Attributes;

class Liquidity {
    public static function compute($liquidity, $sales, $balanceSheets) : array
    {
        $liquidity['current_ratio'] = round($balanceSheets['current_assets'] / $balanceSheets['current_liabilities'], 2). ':1' ?? "";
        $liquidity['cash_ratio'] = round($balanceSheets['cash'] / $balanceSheets['current_liabilities'], 2). ':1' ?? "";;
        $liquidity['working_capital'] = $balanceSheets['current_assets'] - $balanceSheets['current_liabilities'];
        $liquidity['recommended_working_capital'] = ($balanceSheets['current_liabilities'] * 1.50) - $balanceSheets['current_liabilities'];
        $liquidity['working_capital_turnover'] = $sales / $liquidity['working_capital'];

        return $liquidity;
    }
}
