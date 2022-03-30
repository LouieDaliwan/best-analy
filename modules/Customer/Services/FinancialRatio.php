<?php

namespace Customer\Services;

use Customer\Models\Attributes\AdditionalRatio;
use Customer\Models\Customer;
use Customer\Models\Attributes\Liquidity;
use Customer\Models\Attributes\Efficiency;
use Customer\Models\Attributes\BalanceSheet;
use Customer\Models\Attributes\Profitability;
use Customer\Services\FinancialRatioInterface;
use Customer\Models\Attributes\ProfitStatement;
use Customer\Models\Attributes\Rendering;
use Customer\Models\Attributes\Solvency;

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
        $solvency = Solvency::compute($this->ratioAnalysis['solvency'], $balanceSheets);

        $this->ratioAnalysis['dashboard']['debt_ratio']['score'] = $solvency['debt_ratio'];

        $this->ratioAnalysis['solvency'] = $solvency;
    }

    protected function computeProductivity()
    {
        $statements = $this->statements['metadataStatements'];

        $valueAdded = (float) $statements['Value Added'];
        $staffSalaries = (float) $statements['Staff Salaries & Benefits'];

        $this->ratioAnalysis['productivity']['labour_cost_competitiveness'] = $staffSalaries != 0 ? round($valueAdded / $staffSalaries, 2) : 0;
    }

    protected function computeAdditionalRatio()
    {
        $additionalRatio = AdditionalRatio::compute(
            $this->ratioAnalysis['additional_ratios'],
            $this->customer,
            $this->statements
        );

        $this->ratioAnalysis['dashboard']['raw_materials']['score'] = $additionalRatio['raw_materials_margin'];
        $this->ratioAnalysis['dashboard']['roi']['score'] = $additionalRatio['roi'];

        $this->ratioAnalysis['additional_ratios'] = $additionalRatio;
    }

    protected function renderScoreResult()
    {
        $this->ratioAnalysis['dashboard'] = Rendering::results($this->ratioAnalysis, $this->statements, $this->customer);
    }
}
