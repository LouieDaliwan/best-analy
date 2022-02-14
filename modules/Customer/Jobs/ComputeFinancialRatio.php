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
        ->take(3)
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

        dd($this->overAllResults);
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

                $results[$childKey] = (int) $results[$childKey] > 0 ? (int) $results[$childKey] : ((int) $results[$childKey] * -1);

            }
        }

        return $results;
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

        $this->overAllResults['profitStatements'] = $profitStatement;
    }
}
