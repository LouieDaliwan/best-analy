<?php

namespace Customer\Jobs;

use Customer\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Customer\Services\CustomerServiceInterface;

class ComputeFinancialRatio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        'cogs_margin' => [
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
        ]
    ];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $statements = $this->customer->statements()
        ->latest()
        ->take(1)
        ->get(['metadataStatements', 'metadataSheets'])->toArray();

        $sheets = collect([]);
        $info_statements = collect([]);

        foreach ($statements as $key => $value) {
            $sheets->push($value['metadataSheets']);
            $info_statements->push($value['metadataStatements']);
        }

        $sheetResults =  $this->computeValues($sheets->toArray());

        $infoStatementResults  = $this->computeValues($info_statements->toArray());

        $this->computeProfitStatement($infoStatementResults);

        $this->computeBalanceSheet($sheetResults);

        $this->keyRatioAnalysisGetPercentage();
    }
    protected function computeValues($attributes)
    {
        $results = [];

        foreach ($attributes as $key => $value) {

            foreach($value as $childKey => $childValue) {

                if (collect(['period', 'Balance'])->intersect([$childKey])->isNotEmpty()) {
                    continue;
                }

                isset($results[$childKey]) ? : $results[$childKey] = 0;

                if($results[$childKey] == 0) {
                    $results[$childKey] += (int) $value[$childKey] ?? '0';
                } else {
                    $results[$childKey] -= (int) $value[$childKey] ?? '0';
                }

                $results[$childKey] = (int) $results[$childKey] > 0 ? (int) $results[$childKey] : abs((int) $results[$childKey]);
            }
        }

        return $results;
    }

    protected function computeBalanceSheet($sheetResults)
    {
        $balanceSheets = [];

        $balanceSheets['current_assets'] = 0;
        $balanceSheets['current_liabilities'] = 0;
        $balanceSheets['non_current_liabilities'] = 0;

        foreach ($sheetResults as $key => $value) {
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

    protected function computeProfitStatement($infoStatement)
    {
        //TODO optimize --Louie Daliwan
        $profitStatement = [];

        $profitStatement['sales'] = $infoStatement['Sales'];
        $profitStatement['cost_goods'] = abs((
            $infoStatement["Raw Materials (direct & indirect)"] + $infoStatement['Change Inventory']
        ));

        $profitStatement['operating_expenses'] = abs((
            $infoStatement['Production Costs'] +
            $infoStatement['General Management Costs'] +
            $infoStatement['Labour Expenses']
        ));

        $profitStatement['non_operating_expenses'] = abs((
            $infoStatement['Non-Operating Expenses(Non-Operating Expense Less Income)'] +
            $infoStatement['Interest On Loan/Hires']
        ));

        $profitStatement['operating_loss_or_profit'] = abs((
            $profitStatement['sales'] -
            $profitStatement['cost_goods'] -
            $profitStatement['operating_expenses'] -
            $profitStatement['non_operating_expenses']
        ));

        $profitStatement['depreciation'] = $infoStatement['Depreciation'];
        $profitStatement['taxes'] = $infoStatement['Taxation'];
        $profitStatement['net_loss_profit_after_taxes'] = abs((
            $profitStatement['operating_loss_or_profit'] -
            $profitStatement['depreciation'] -
            $profitStatement['taxes']
        ));

        $profitStatement['gross_profit'] = abs(($profitStatement['sales'] - $profitStatement['cost_goods']));
        $profitStatement['total_other_expenses'] = ($profitStatement['operating_expenses'] + $infoStatement['Non-Operating Expenses(Non-Operating Expense Less Income)'] + $profitStatement['taxes']);
        $profitStatement['net_income_loss'] = abs(($profitStatement['gross_profit'] - $profitStatement['total_other_expenses']));

        $this->overAllResults['profitStatements'] = $profitStatement;
    }

    protected function keyRatioAnalysisGetPercentage()
    {
        $ratioAnalysis = $this->ratioAnalysis;

        $resultsProfitStatements = $this->overAllResults['profitStatements'];
        $resultsBalanceSheets = $this->overAllResults['balanceSheets'];

        $ratioAnalysis['gross_profit_margin']['percentage'] = $resultsProfitStatements['sales'] > 0 ? ($resultsProfitStatements['gross_profit'] / $resultsProfitStatements['sales'])  * 100 : 0;
        $ratioAnalysis['net_profit_margin']['percentage'] = $resultsProfitStatements['sales'] > 0 ? ($resultsProfitStatements['net_income_loss'] / $resultsProfitStatements['sales'])  * 100 : 0;
        $ratioAnalysis['cogs_margin']['percentage'] = $resultsProfitStatements['cost_goods'] > 0 ? ($resultsProfitStatements['cost_goods'] / $resultsProfitStatements['sales'])  * 100 : 0;
        $ratioAnalysis['breakeven_point'] = $resultsProfitStatements['total_other_expenses'] > 0 ? ($resultsProfitStatements['total_other_expenses'] / $ratioAnalysis['gross_profit_margin']['percentage']) * 100 : 0;

        $ratioAnalysis['current_ratio_margin']['percentage'] = $resultsBalanceSheets['current_liabilities'] > 0 ? ($resultsBalanceSheets['current_assets'] / $resultsBalanceSheets['current_liabilities']) * 100 : 0;
        $ratioAnalysis['working_capital'] = abs($resultsBalanceSheets['current_assets'] - $resultsBalanceSheets['current_liabilities']);

        $totalShareLongTerm = $resultsBalanceSheets['total_long_term_liabilities'] + $resultsBalanceSheets['total_share_equity'];
        $ratioAnalysis['long_term_ratio']['percentage'] = $totalShareLongTerm > 0 ? ($resultsBalanceSheets['total_long_term_liabilities'] / $totalShareLongTerm) * 100 : 0;

        $ratioAnalysis['roi']['percentage'] = 0;

        $this->ratioAnalysis = $ratioAnalysis;
    }
}
