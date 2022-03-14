<?php

namespace Customer\Services;

use Customer\Models\Customer;
use Customer\Models\Attributes\Liquidity;
use Customer\Models\Attributes\Efficiency;
use Customer\Models\Attributes\BalanceSheet;
use Customer\Models\Attributes\Profitability;
use Customer\Services\FinancialRatioInterface;
use Customer\Models\Attributes\ProfitStatement;

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

    public function compute(Customer $customer, $statements)
    {
        $this->statements = $statements;
        $this->customer = $customer;

        $period = $statements['metadataStatements']['period'];

        unset(
            $statements['metadataStatements']['period'],
            $statements['metadataSheets']['period'],
            $statements['metadataSheets']['Balance']
        );

        $this->customer = $customer;

        $this->computeProfitStatement($statements['metadataStatements']);

        $this->computeBalanceSheet($statements['metadataSheets']);

        $this->computeRatioAnalysis($customer);

        $customer->statements()->updateOrCreate(
            [
                'customer_id' => $customer->id,
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

        $efficiency = new Efficiency($customer, $period);

        $efficiency->compute();

      }

    protected function computeProfitStatement($infoStatement)
    {
        $this->overAllResults['profitStatements'] = ProfitStatement::compute($infoStatement);
    }

    protected function computeBalanceSheet($sheets)
    {
        $this->overAllResults['balanceSheets'] = BalanceSheet::compute($sheets);
    }

    protected function computeRatioAnalysis()
    {
        $profitStatements = $this->overAllResults['profitStatements'];

        $balanceSheets = $this->overAllResults['balanceSheets'];

        $sales = (int) $profitStatements['sales'];

        $this->computeProfitability($sales, $profitStatements, $balanceSheets);

        $this->computeLiquidity($sales, $balanceSheets);

        $this->computeSolvency($balanceSheets);

        $this->computeProductivity();

        $this->computeAdditionalRatio();

        $this->renderScoreResult();
    }

    protected function computeProfitability($sales, $profitStatements, $balanceSheets)
    {
        $profitability = Profitability::compute($this->ratioAnalysis['profitability'], $sales, $profitStatements, $balanceSheets);

        $this->ratioAnalysis['dashboard']['gross_margin']['score'] = $profitability['gross_profit_margin'];
        $this->ratioAnalysis['dashboard']['net_margin']['score'] = $profitability['net_profit_margin'];

        $this->ratioAnalysis['profitability'] = $profitability;
    }

    protected function computeLiquidity($sales, $balanceSheets)
    {
        $this->ratioAnalysis['liquidity'] = Liquidity::compute($this->ratioAnalysis['liquidity'], $sales, $balanceSheets);

        $this->ratioAnalysis['dashboard']['current_ratio']['score'] = $balanceSheets['current_liabilities'] != 0 ?
         round($balanceSheets['cash'] / $balanceSheets['current_liabilities'], 2) : 0;

    }

    protected function computeSolvency($balanceSheets)
    {
        $solvency = $this->ratioAnalysis['solvency'];

        $solvency['debt_to_equity_ratio'] = (float) $balanceSheets['stockholdersequity'] != 0  ?
        ((float) $balanceSheets['total_liabilities'] / (float) $balanceSheets['stockholdersequity']) : 0;

        $solvency['debt_ratio'] = (float) $balanceSheets['total_assets'] != 0 ? ((float) $balanceSheets['total_liabilities'] / (float) $balanceSheets['total_assets']) : 0;

        $this->ratioAnalysis['dashboard']['debt_ratio']['score'] = $solvency['debt_ratio'];

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

        $investmentValue = (int) $this->customer->detail->metadata['investment_value'];

        $additionalRatio = $this->ratioAnalysis['additional_ratios'];
        $additionalRatio['raw_materials_margin'] = (float) $statements['Sales'] != 0 ? (float) $statements['Raw Materials'] / (float) $statements['Sales'] : 0;

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

        if ($projectType !=  "") {

            $projectTypeValues = config("fratio.{$projectType}");

            foreach ($projectTypeValues as $ratioKey => $ratioValue) {

                $ratio = $this->ratioAnalysis['dashboard'][$ratioKey];

                foreach ($ratioValue as $remark => $remarkPoints) {

                    $remarks = '';

                    $remarkPoint1 = (float) $remarkPoints[0];
                    $remarkPoint2 = (float) isset($remarkPoints[1]) ? $remarkPoints[1] : 0;

                    if ($ratio['score'] >= $remarkPoint1 && $ratio['score'] <= $remarkPoint2) {
                        $remarks = $remark;
                    }

                    if ($remark == 'Very Poor' && $ratio['score'] < $remarkPoint1) {
                        $remarks = 'Very Poor';
                    }

                    if ($ratio['score'] >= $remarkPoint1 && $remarkPoint2 == 0) {
                        $remarks = $remark;
                    }

                    $this->ratioAnalysis['dashboard'][$ratioKey]['color'] = $this->colorStatus($remarks);
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
