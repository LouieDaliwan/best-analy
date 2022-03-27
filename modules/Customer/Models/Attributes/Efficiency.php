<?php

namespace Customer\Models\Attributes;

class Efficiency
{
    protected $customerStatements;

    protected $customer;

    protected $statements = [
        'statement1' => [],
        'statement2' => [],
        'statement3' => [],
    ];

    protected $countFillItem = 0;

    protected $period;

    public function __construct($customer, $period)
    {
        $this->customer = $customer;

        $this->queryStatement($period);

    }

    protected function queryStatement($period)
    {
        $this->customerStatements = $this->customer
        ->statements()
        ->get()
        ->toArray();

        $this->fillStatement($period);
    }

    protected function fillStatement($period)
    {
        foreach ($this->customerStatements as $index => $customerStatement) {
            if ($customerStatement['period'] == $period) {

                $firstIndex = $index - 1;
                $thirdIndex = $index + 1;

                if ($index == 0) {
                    $firstIndex = 0;
                    $index = $index + 1;
                    $thirdIndex = 2;
                }

                if (count($this->customerStatements) == 1) {
                    $this->statements['statement1'] = $this->customerStatements[$firstIndex];
                }

                if (count($this->customerStatements) == 2) {
                    $this->statements['statement1'] = !isset($this->customerStatements[$firstIndex]) ? []: $this->customerStatements[$firstIndex];
                    $this->statements['statement2'] = !isset($this->customerStatements[$index]) ? []: $this->customerStatements[$index];
                }

                if (count($this->customerStatements) >= 3) {
                    $this->statements['statement1'] = !isset($this->customerStatements[$firstIndex]) ? []: $this->customerStatements[$firstIndex];
                    $this->statements['statement2'] = !isset($this->customerStatements[$index]) ? []: $this->customerStatements[$index];
                    $this->statements['statement3'] = !isset($this->customerStatements[$thirdIndex]) ? []: $this->customerStatements[$thirdIndex];
                }
            }
        }

        $this->countFillItem = collect($this->statements)->filter(function($statement, $key) {
            return !empty($statement);
        })->count();
    }

    public function compute() : void
    {
        if($this->countFillItem == 1) {
            $this->computePeriodOne();
        }

        if($this->countFillItem == 2) {
            $this->computePeriodTwo();
        }

        if($this->countFillItem == 3) {
            $this->computePeriodTwo();
            $this->computePeriodThree();
        }

        $this->save();
    }

    protected function computePeriodOne()
    {
        //TODO optimize
        $profiStatement = $this->statements['statement1']['metadataResults']['overAllResults']['profitStatements'];
        $balanceSheets =  $this->statements['statement1']['metadataResults']['overAllResults']['balanceSheets'];

        if ((float) $balanceSheets['total_assets'] != 0) {
            $this->statements['statement1']['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = divide((float) $profiStatement['sales'], $balanceSheets['total_assets']);
        }

        if ((float) $balanceSheets['inventories'] != 0) {
            $this->statements['statement1']['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = divide((float) $profiStatement['cost_goods'], (float) $balanceSheets['inventories']);
        }
    }

    protected function computePeriodTwo()
    {
        $profiStatement = $this->statements['statement2']['metadataResults']['overAllResults']['profitStatements'];
        $balanceSheets =  $this->statements['statement2']['metadataResults']['overAllResults']['balanceSheets'];

        $balanceSheets1 =  $this->statements['statement1']['metadataResults']['overAllResults']['balanceSheets'];

        if((float) $balanceSheets['total_assets'] != 0) {
            $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = divide((float) $profiStatement['sales'] , (float) $balanceSheets['total_assets']);
        }

        if((float) $balanceSheets['inventories'] != 0){
            $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = divide((float) $profiStatement['cost_goods'], (float) $balanceSheets['inventories']);
        }

        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover'] = round(((float) $balanceSheets1['tradereceivables'] + $balanceSheets['tradereceivables']) / 2, 2);
        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover'] = round((float) $profiStatement['sales'] / (((float) $balanceSheets1['tradereceivables'] + $balanceSheets['tradereceivables']) / 2), 2);

        if($this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover'] != 0){
            $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days']  = round((365 / $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover']), 2);
        }

        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover'] = round(((float) $balanceSheets1['tradepayables'] + $balanceSheets['tradepayables']) / 2, 2);
        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover'] = round((float) $profiStatement['cost_goods'] / (((float) $balanceSheets1['tradepayables'] + $balanceSheets['tradepayables']) / 2), 2);

        if($this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover'] != 0) {
            $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days']  = round((365 / $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover']), 2);
        }
    }

    protected function computePeriodThree()
    {
        $profiStatement = $this->statements['statement3']['metadataResults']['overAllResults']['profitStatements'];
        $balanceSheets = $this->statements['statement3']['metadataResults']['overAllResults']['balanceSheets'];

        $balanceSheets2 =  $this->statements['statement2']['metadataResults']['overAllResults']['balanceSheets'];

        if ((float) $balanceSheets['total_assets'] != 0) {
            $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = divide((float) $profiStatement['sales'], (float) $balanceSheets['total_assets']);
        }

        if ((float) $balanceSheets['inventories'] != 0) {
            $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = divide((float) $profiStatement['cost_goods'], (float) $balanceSheets['inventories']);
        }

        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover'] = round(((float) $balanceSheets2['tradereceivables'] + $balanceSheets['tradereceivables']) / 2, 2);
        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover'] = round((float) $profiStatement['sales'] / (((float) $balanceSheets2['tradereceivables'] + $balanceSheets['tradereceivables']) / 2), 2);

        if ($this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover'] != 0) {
            $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days']  = round((
                365 / $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover']
            ), 2);
        }

        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover'] = round(((float) $balanceSheets2['tradepayables'] + $balanceSheets['tradepayables']) / 2, 2);
        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover'] = round((float) $profiStatement['cost_goods'] / (((float) $balanceSheets2['tradepayables'] + $balanceSheets['tradepayables']) / 2), 2);

        if ($this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover'] != 0) {
            $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days']  = round((
                365 / $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover']
            ), 2);
        }
    }

    protected function save()
    {
        foreach ($this->statements as $statement) {
            if(!empty($statement)) {
                $this->customer->statements()->updateOrCreate(
                    [
                        'customer_id' => $this->customer->id,
                        'period' => $statement['period']
                    ],
                    [
                        'metadataResults' => $statement['metadataResults']
                    ]
                );
            }
        }
    }
}
