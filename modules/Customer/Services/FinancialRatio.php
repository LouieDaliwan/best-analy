<?php

namespace Customer\Services;

use Customer\Models\Customer;
use Customer\Services\FinancialRatioInterface;

class FinancialRatio implements FinancialRatioInterface
{
    protected $customer;

    protected $statements;

    protected $overAllResults = [
        'profitStatements' => [],
        'balanceSheets' => []
    ];

    protected $ratioAnalysis;

    public function __construct()
    {
        $this->ratioAnalysis = config('fratio.format');
    }

    public function compute(Customer $customer, $statements, $id)
    {
        $this->statements = $statements;
        $this->customer = $customer;

        $period = $statements['metadataStatements']['period'];
        // $statement_id = $statements['id'] ;

        unset(
            $statements['metadataStatements']['period'],
            $statements['metadataSheets']['period'],
            $statements['metadataSheets']['Balance']
        );

        $this->customer = $customer;

        $this->computeProfitStatement($statements['metadataStatements']);

        $this->computeBalanceSheet($statements['metadataSheets']);

        $this->computeRatioAnalysis($statements);


        $customer->statements()->updateOrCreate(
            [
                'customer_id' => $id,
                // 'id' => $statement_id,
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

        $this->computeSolvency($balanceSheets);

        $this->computeProductivity();

        $this->computeAdditionalRatio();

        $this->renderScoreResult();
    }

    protected function computeProfitability($sales, $profitStatements, $balanceSheets)
    {
        //TODO optimize
        $profitability = $this->ratioAnalysis['profitability'];

        $total_assets = (float) $balanceSheets['total_assets'];
        $stock_holder = (float) $balanceSheets['stockholdersequity'];
        $common_share = (float) $balanceSheets['commonsharesoutstanding'];

        $profitability['gross_profit_margin'] = $sales != 0 ? (($sales - $profitStatements['cost_goods']) / $profitStatements['cost_goods']) * 100 : 0;
        $profitability['operating_profit_margin'] = $sales != 0 ? ($profitStatements['operating_loss_or_profit'] / $sales) * 100 : 0;
        $profitability['net_profit_margin'] = $sales != 0 ? ($profitStatements['net_loss_profit_after_taxes'] / $sales) * 100 : 0;
        $profitability['return_on_assets'] = $total_assets != 0 ? ($profitStatements['net_loss_profit_after_taxes'] / $total_assets) : 0;
        $profitability['return_on_equity'] = $stock_holder !=  0 ? ($profitStatements['net_loss_profit_after_taxes'] / $stock_holder) : 0;
        $profitability['earnings_per_share'] = $common_share != (null || 0) ? ($profitStatements['net_loss_profit_after_taxes'] / $common_share ) : 0;
        $profitability['operating_ratio'] = round($profitStatements['operating_expenses'] / $sales, 2). ':1' ?? "";


        $this->ratioAnalysis['dashboard']['gross_margin']['score'] = $profitability['gross_profit_margin'];
        $this->ratioAnalysis['dashboard']['net_margin']['score'] = $profitability['net_profit_margin'];

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

        $this->ratioAnalysis['dashboard']['current_ratio']['score'] = round($balanceSheets['cash'] / $balanceSheets['current_liabilities'], 2);
        $this->ratioAnalysis['dashboard']['debt_ratio']['score'] = $balanceSheets['total_long_term_liabilities'] ?? 0;

        $this->ratioAnalysis['liquidity'] = $liquidity;
    }

    protected function computeEfficiency($sales, $profitStatement, $balanceSheets)
    {
        $efficiency = $this->ratioAnalysis['efficiency'];

        // $efficiency['']

        $this->ratioAnalysis['efficiency'] = $efficiency;
    }

    protected function computeSolvency($balanceSheets)
    {
        $solvency = $this->ratioAnalysis['solvency'];

        $solvency['debt_to_equity_ratio'] = (float) $balanceSheets['total_liabilities'] / (float) $balanceSheets['stockholdersequity'];
        $solvency['debt_ratio'] = (float) $balanceSheets['total_liabilities'] / (float) $balanceSheets['total_assets'];

        $this->ratioAnalysis['solvency'] = $solvency;
    }

    protected function computeProductivity()
    {
        $statements = $this->statements['metadataStatements'];

        $valueAdded = (float) $statements['Value Added'];
        $staffSalaries = (float) $statements['Staff Salaries & Benefits'];

        $this->ratioAnalysis['productivity']['labour_cost_competitiveness'] = $staffSalaries != 0 ? $valueAdded / $staffSalaries : 0;
    }

    protected function computeAdditionalRatio()
    {
        $statements = $this->statements['metadataStatements'];

        $investmentValue = $this->customer->detail->metadata['investment_value'];

        $additionalRatio = $this->ratioAnalysis['additional_ratios'];
        $additionalRatio['raw_materials_margin'] = (float) $statements['Raw Materials'] / (float) $statements['Sales'];
        $additionalRatio['roi'] = $investmentValue != (null || 0) ? $statements['Net Operating Profit/(Loss)'] / $investmentValue : 0;

        $this->ratioAnalysis['dashboard']['raw_materials']['score'] = $additionalRatio['raw_materials_margin'];
        $this->ratioAnalysis['dashboard']['roi']['score'] = $additionalRatio['roi'];

        $this->ratioAnalysis['additional_ratios'] = $additionalRatio;
    }

    protected function renderScoreResult()
    {
        $period = $this->statements['metadataStatements']['period'];
        $projectType = $this->customer->detail->metadata['project_type'];

        $this->ratioAnalysis['dashboard']['date'] = $period;
        $this->ratioAnalysis['dashboard']['project_type'] = $projectType;

        $projectType = strtolower(
            str_replace(" ", "_", $this->customer->detail->metadata['project_type'])
        );

        $projectTypeValues = config("fratio.{$projectType}");

        foreach ($projectTypeValues as $ratioKey => $ratioValue) {

            $ratio = $this->ratioAnalysis['dashboard'][$ratioKey];

            foreach ($ratioValue as $remarkPoint => $remark) {

                $remarkPoint = (float) $remarkPoint;

                if ($ratio['score'] <=  $remarkPoint || $ratio['score'] == 0) {
                    $this->ratioAnalysis['dashboard'][$ratioKey]['color'] = $this->colorStatus($remark);
                }

                if($ratio['score'] >= $remarkPoint) {
                    $this->ratioAnalysis['dashboard'][$ratioKey]['color'] = $this->colorStatus('Excellent');
                }
            }

        }
    }

    protected function coLorStatus($remark)
    {
        switch ($remark) {
            case "Very Poor" :
                $color = '#F20000';
                break;
            case "Poor":
                $color = '#F9BE00';
                break;
            case "Moderate":
                $color = '#8A2B91';
                break;
            case "Good":
                $color = '#9BCF44';
                break;
            case "Excellent":
                $color = '#40AF49';
                break;
            default:
                $color = '#F20000';
        }

        return $color;
    }
}
