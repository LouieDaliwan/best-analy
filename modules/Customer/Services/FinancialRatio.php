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
        'profitability' => [
            'net_profit_margin' => 0,
            'gross_profit_margin' => 0,
            'operating_profit_margin' => 0,
            'return_on_assets' => 0,
            'return_on_equity' => 0,
            'earnings_per_share' => 0,
            'operating_ratio' => 0,
        ],
        'liquidity' => [
            'current_ratio' => 0,
            'cash_ratio' => 0,
            'working_capital' => 0,
            'recommended_working_capital' => 0,
            'working_capital_turnover' => 0,
        ],
        'efficiency' => [
            'trade_receivable_turnover' => 0,
            'avg_trade_receivable_turnover' => 0,
            'trade_payable_turnover' => 0,
            'avg_trade_payable_turnover' => 0,
            'assets_turnover_ratio' => 0,
            'inventory_turnover_ratio' => 0,
        ],
        'solvency' => [
            'debt_to_equity_ratio' => 0,
            'debt_ratio' => 0,
        ],
        'productivity' => [
            'labour_cost_comptetitiveness' => 0,
        ],
        'additional_ratios' => [
            'raw_materials_margin' => 0,
            'roi' => 0,
        ]
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


        $this->customer = $customer;

        $this->computeProfitStatement($statements['metadataStatements']);

        $this->computeBalanceSheet($statements['metadataSheets']);

        $this->computeRatioAnalysis($statements);
        // dd($this->computeRatioAnalysis());

        // $customer->statements()->updateOrCreate(
        //     [
        //         'customer_id' => $id,
        //         'id' => $statement_id,
        //         'period' => $period,
        //     ],
        //     [
        //         'metadataStatements' => $statements['metadataStatements'],
        //         'metadataSheets' => $statements['metadataSheets'],
        //         'metadataResults' => [
        //                 'overAllResults' => $this->overAllResults,
        //                 'ratioAnalysis' => $this->ratioAnalysis,
        //             ],
        //     ]
        // );
    }

    protected function computeProfitStatement($infoStatement)
    {
        //TODO optimize --Louie Daliwan
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

    protected function computeRatioAnalysis()
    {
        $profitStatements = $this->overAllResults['profitStatements'];
        $balanceSheets = $this->overAllResults['balanceSheets'];

        $sales = (int) $profitStatements['sales'];

        $this->computeProfitability($sales, $profitStatements, $balanceSheets);
        $this->computeLiquidity($sales, $balanceSheets);
        // $this->computeEfficiency($sales, $profitStatements, $balanceSheets); // pending
        $this->computeSolvency($sales, $profitStatements, $balanceSheets);


    }

    protected function computeProfitability($sales, $profitStatements, $balanceSheets)
    {
        //TODO optimize
        $profitability = $this->ratioAnalysis['profitability'];

        $total_assets = (int) $balanceSheets['total_assets'];
        $stock_holder = (int) $balanceSheets['stockholdersequity'];
        $common_share = (int) $balanceSheets['commonsharesoutstanding'];

        $profitability['gross_profit_margin'] = $sales != 0 ? (($sales - $profitStatements['cost_goods']) / $profitStatements['cost_goods']) * 100 : 0;
        $profitability['operating_profit_margin'] = $sales != 0 ? ($profitStatements['operating_loss_or_profit'] / $sales) * 100 : 0;
        $profitability['net_profit_margin'] = $sales != 0 ? ($profitStatements['net_loss_profit_after_taxes'] / $sales) * 100 : 0;
        $profitability['return_on_assets'] = $total_assets != 0 ? ($profitStatements['net_loss_profit_after_taxes'] / $total_assets) : 0;
        $profitability['return_on_equity'] = $stock_holder !=  0 ? ($profitStatements['net_loss_profit_after_taxes'] / $stock_holder) : 0;
        $profitability['earnings_per_share'] = $common_share != (null || 0) ? ($profitStatements['net_loss_profit_after_taxes'] / $common_share ) : 0;
        $profitability['operating_ratio'] = round($profitStatements['operating_expenses'] / $sales, 2). ':1' ?? "";

        $this->ratioAnalysis['profitability'] = $profitability;
    }

    protected function computeLiquidity($sales, $balanceSheets)
    {
        //TODO optimize
        $liquidity = $this->ratioAnalysis['liquidity'];

        $liquidity['current_ratio'] = round($balanceSheets['current_assets'] / $balanceSheets['current_liabilities'], 2). ':1' ?? "";
        $liquidity['cash_ratio'] = round($balanceSheets['cash'] / $balanceSheets['current_liabilities'], 2). ':1' ?? "";;
        $liquidity['working_capital'] = $balanceSheets['current_assets'] - $balanceSheets['current_liabilities'];
        $liquidity['recommended_working_capital'] = ($balanceSheets['current_liabilities'] * 1.50) - $balanceSheets['current_liabilities'];
        $liquidity['working_capital_turnover'] = $sales / $liquidity['working_capital'];

        $this->ratioAnalysis['liquidity'] = $liquidity;
    }

    protected function computeEfficiency($sales, $profitStatement, $balanceSheets)
    {
        $efficiency = $this->ratioAnalysis['efficiency'];

        // $efficiency['']


        $this->ratioAnalysis['efficiency'] = $efficiency;
    }

    protected function computeSolvency($sales, $profitStatement, $balanceSheets)
    {
        
    }
}
