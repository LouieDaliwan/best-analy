<?php

namespace Customer\Models\Attributes;

class Profitability
{
    public static function compute($profitability, $sales, $profitStatements, $balanceSheets)
    {
        $total_assets = (float) $balanceSheets['total_assets'];
        $stock_holder = (float) $balanceSheets['stockholdersequity'];
        $common_share = (float) $balanceSheets['commonsharesoutstanding'];

        $profitability['gross_profit_margin'] = $sales != 0 ? (($sales - $profitStatements['cost_goods']) / $profitStatements['cost_goods']) * 100 : 0;
        
        $profitability['operating_profit_margin'] = $sales != 0 ? ($profitStatements['operating_loss_or_profit'] / $sales) * 100 : 0;

        $profitability['net_profit_margin'] = $sales != 0 ? ($profitStatements['net_loss_profit_after_taxes'] / $sales) * 100 : 0;

        $profitability['return_on_assets'] = $total_assets != 0 ? ($profitStatements['net_loss_profit_after_taxes'] / $total_assets) : 0;

        $profitability['return_on_equity'] = $stock_holder !=  0 ? ($profitStatements['net_loss_profit_after_taxes'] / $stock_holder) : 0;

        $profitability['earnings_per_share'] = $common_share != (null || 0) ? ($profitStatements['net_loss_profit_after_taxes'] / $common_share ) : 0;

        $profitability['operating_ratio'] = $profitStatements['operating_expenses'] != 0 ? round($profitStatements['operating_expenses'] / $sales, 2). ':1' : 0;


        return $profitability;
    }
}