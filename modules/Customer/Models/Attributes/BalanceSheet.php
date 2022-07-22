<?php

namespace Customer\Models\Attributes;

class BalanceSheet {

    public static function compute($sheets)
    {
        $balanceSheets = [];

        $balanceSheets['current_assets'] = 0;
        $balanceSheets['current_liabilities'] = 0;
        $balanceSheets['non_current_liabilities'] = 0;

        foreach ($sheets as $key => $value) {
            
            $key = str_replace([" ", "'", "-"], "", strtolower($key));

            isset($balanceSheets[$key]) ? : $balanceSheets[$key] = (float) $value;
        }
        
        $balanceSheets['current_assets'] = (float) $sheets['Current Asset'];
        $balanceSheets['current_liabilities'] = (float) $sheets['Current Liabilities'];
        $balanceSheets['non_current_liabilities'] = (float) $sheets['Non-Current Liabilities'];
        $balanceSheets['total_assets'] = ($balanceSheets['current_assets'] + $balanceSheets['fixedassets']);
        $balanceSheets['total_liabilities'] = ($balanceSheets['current_liabilities'] + $balanceSheets['non_current_liabilities']);
        $balanceSheets['total_share_equity'] = ($balanceSheets['stockholdersequity'] + $balanceSheets['commonsharesoutstanding']);
        $balanceSheets['total_long_term_liabilities'] = $balanceSheets['othernoncurrentliabilities'];

        return $balanceSheets;
    }
}
