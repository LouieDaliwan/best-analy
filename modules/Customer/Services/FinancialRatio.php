<?php

namespace Customer\Services;

use Customer\Models\Customer;
use Customer\Services\FinancialRatioInterface;

class FinancialRatio implements FinancialRatioInterface
{
    protected $customer;

    protected $overAllResults = [
        'profitStatements' => [],
        'balanceSheets' => []
    ];

    protected $ratioAnalysis = [
        'breakeven_point' => 0,
        'working_capital' => 0,
        'net_profit_margin' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.2,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'gross_profit_margin' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.1,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'operating_profit_margin' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.2,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'long_term_ratio' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.15,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'current_ratio_margin' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.2,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'roi' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.15,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'overall_score' => [
            'score' => 0,
            'status' => '',
            'color_status' => 0,
            'total_rating' => 0,
            'total_out_of' => 0,
        ],


    ];

    public function compute(Customer $customer, $statements, $id)
    {
        $period = $statements['metadataStatements']['period'];
        $statement_id = $statements['id'];

        unset(
            $statements['metadataStatements']['period'],
            $statements['metadataSheets']['period'],
            $statements['metadataSheets']['Balance']
        );

        $this->computeProfitStatement($statements['metadataStatements']);

        $this->computeBalanceSheet($statements['metadataSheets']);

        $customer->statements()->updateOrCreate(
            [
                'customer_id' => $id,
                'id' => $statement_id,
                'period' => $period,
            ],
            [
                'metadataStatements' => $statements['metadataStatements'],
                'metadataSheets' => $statements['metadataSheets'],
                'metadataResults' => [
                        'overAllResults' => $this->overAllResults,
                        'ratioAnalysis' => $this->ratioAnalysis,
                    ],
            ]
        );
    }

    protected function computeProfitStatement($infoStatement)
    {
        //TODO optimize --Louie Daliwan
        $profitStatement = [];

        $profitStatement['sales'] = $infoStatement['Sales'];
        $profitStatement['cost_goods'] = $infoStatement['Cost of Good Sold'];

        $profitStatement['operating_expenses'] = (
            $infoStatement['Production Costs'] +
            $infoStatement['General Management Costs'] +
            $infoStatement['Labour Expenses']
        );

        $profitStatement['non_operating_expenses'] = (
            $infoStatement['Non-Operating Expenses(Non-Operating Expense Less Income)'] +
            $infoStatement['Interest On Loan/Hires']
        );

        $profitStatement['operating_loss_or_profit'] = (
            $profitStatement['sales'] -
            $profitStatement['cost_goods'] -
            $profitStatement['operating_expenses'] -
            $profitStatement['non_operating_expenses']
        );

        $profitStatement['depreciation'] = $infoStatement['Depreciation'];
        $profitStatement['taxes'] = $infoStatement['Taxation'];

        $profitStatement['net_loss_profit_after_taxes'] =
            $profitStatement['operating_loss_or_profit'] -
            $profitStatement['depreciation'] -
            $profitStatement['taxes'];

        $profitStatement['gross_profit'] = $profitStatement['sales'] - $profitStatement['cost_goods'];
        $profitStatement['total_other_expenses'] = $profitStatement['operating_expenses'] + $infoStatement['Non-Operating Expenses(Non-Operating Expense Less Income)'] + $profitStatement['taxes'];
        $profitStatement['net_income_loss'] = $profitStatement['gross_profit'] - $profitStatement['total_other_expenses'];

        $this->overAllResults['profitStatements'] = $profitStatement;
    }


    protected function computeBalanceSheet($sheets)
    {
        $balanceSheets = [];

        $balanceSheets['current_assets'] = 0;
        $balanceSheets['current_liabilities'] = 0;
        $balanceSheets['non_current_liabilities'] = 0;

        foreach ($sheets as $key => $value) {

            $key = str_replace([" ", "'"], "", strtolower($key));

            isset($balanceSheets[$key]) ? : $balanceSheets[$key] = $value;

            if (collect(['cash', 'tradereceivables', 'inventories', 'otherca'])->intersect([$key])->isNotEmpty()) {
                $balanceSheets['current_assets'] += $balanceSheets[$key];
            }

            if (collect(['tradepayables', 'othercl'])->intersect([$key])->isNotEmpty()) {
                $balanceSheets['current_liabilities'] += $balanceSheets[$key];
            }

            if (collect(['stockholdersequity', 'otherncl', 'commonsharesoutstanding'])->intersect([$key])->isNotEmpty()) {
                $balanceSheets['non_current_liabilities'] += $balanceSheets[$key];
            }
        }

        $balanceSheets['total_assets'] = ($balanceSheets['current_assets'] + $balanceSheets['fixedassets']);
        $balanceSheets['total_liabilities'] = ($balanceSheets['current_liabilities'] + $balanceSheets['non_current_liabilities']);
        $balanceSheets['total_share_equity'] = ($balanceSheets['stockholdersequity'] + $balanceSheets['commonsharesoutstanding']);
        $balanceSheets['total_long_term_liabilities'] = $balanceSheets['otherncl'];

        $this->overAllResults['balanceSheets'] = $balanceSheets;
    }

    protected function computeRatioAnalysis($statements)
    {
        $this->ratioAnalysis['gross_profit_margin']['percentage'] = (($statements['Sales'] - $statements['Cost of Good Sold']) / $statements['Cost of Good Sold']) * 100;
        $this->ratioAnalysis['operating_profit_margin']['percentage'] = (())
    }
}
