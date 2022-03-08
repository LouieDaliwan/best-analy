<?php

namespace Customer\Models\Attributes;

class ProfitStatement {

    public static function compute($infoStatement)
    {
        $profitStatement = [];

        $profitStatement['sales'] = $infoStatement['Sales'];
        $profitStatement['cost_goods'] = $infoStatement['Cost of Good Sold'];

        $profitStatement['operating_expenses'] = (
            $infoStatement['Marketing Costs'] +
            $infoStatement['General Management Costs'] +
            $infoStatement['Staff Salaries & Benefits']
        );

        $profitStatement['non_operating_expenses'] = (
            $infoStatement['Other Expense (less Other Income)'] +
            $infoStatement['Interest On Loan/Hires']
        );

        $profitStatement['operating_loss_or_profit'] = (
            $profitStatement['sales'] -
            $profitStatement['cost_goods'] -
            $profitStatement['operating_expenses'] -
            $profitStatement['non_operating_expenses']
        );

        $profitStatement['depreciation'] = $infoStatement['Depreciation'];
        $profitStatement['taxes'] = $infoStatement['Company Tax'];

        $profitStatement['net_loss_profit_after_taxes'] =
            $profitStatement['operating_loss_or_profit'] -
            $profitStatement['depreciation'] -
            $profitStatement['taxes'];

        return $profitStatement;
    }
}
