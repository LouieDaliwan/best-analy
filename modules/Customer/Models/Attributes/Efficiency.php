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

    protected $period;

    public function __construct($customer, $period)
    {
        $this->customer = $customer;

        $this->queryStatement($period);

    }

    protected function queryStatement($period)
    {
        $this->customerStatements = $this->customer->statements;

        $this->fillStatement($period);
    }

    protected function fillStatement($period)
    {

        foreach ($this->customerStatements as $index => $customerStatement) {

            if ($customerStatement->period == $period) {

                $firstIndex = $index - 1;
                $thirdIndex = $index + 1;

                $this->statements['statement1'] = isset($this->customerStatements[$firstIndex]) ? : $this->customerStatements[$firstIndex];

                $this->statements['statement3'] = isset($this->customerStatements[$thirdIndex]) ? : $this->customerStatements[$firstIndex];

                $this->statements['statement2'] = isset($this->customerStatements[$index]) ? : $this->customerStatements[$index];

            }
        }

    }

    public function compute() : void
    {
        if($this->customerStatements->count() == 1) {
            $this->computePeriodOne();
        }

        if($this->customerStatements->count() == 2) {
            $this->computePeriodTwo();
        }

        if($this->customerStatements->count() == 3) {
            $this->computePeriodThree();
        }

        $this->save();
    }

    protected function computePeriodOne()
    {
        //TODO optimize
        $profiStatement = $this->statements['statement1']['metadataResults']['overAllResults']['profitStatements'];
        $balanceSheets =  $this->statements['statement1']['metadataResults']['overAllResults']['balanceSheets'];

        $this->statements['statement1']['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = (
            (float) $profiStatement['sales'] / (float) $balanceSheets['total_assets']
        );
        $this->statements['statement1']['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = (
            (float) $profiStatement['cost_goods'] / (float) $balanceSheets['inventories']
        );
    }

    protected function computePeriodTwo()
    {
        $profiStatement = $this->statements['statement2']['metadataResults']['overAllResults']['profitStatements'];
        $balanceSheets =  $this->statements['statement2']['metadataResults']['overAllResults']['balanceSheets'];

        $balanceSheets1 =  $this->statements['statement1']['metadataResults']['overAllResults']['balanceSheets'];

        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = (
            (float) $profiStatement['sales'] / (float) $balanceSheets['total_assets']
        );

        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = (
            (float) $profiStatement['cost_goods'] / (float) $balanceSheets['inventories']
        );

        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover'] = (
            (float) $balanceSheets1['tradereceivables'] + $balanceSheets['tradereceivables']
        ) / 2;


        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover'] =
        (float) $profiStatement['sales'] / (((float) $balanceSheets1['tradereceivables'] + $balanceSheets['tradereceivables']) / 2);

        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days']  = (
            365 / $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover']
        );

        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover'] = ((float) $balanceSheets1['tradepayables'] + $balanceSheets['tradepayables']) / 2;

        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover'] =
        (float) $profiStatement['cost_goods'] / (((float) $balanceSheets1['tradepayables'] + $balanceSheets['tradepayables']) / 2);

        $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days']  = (
            365 / $this->statements['statement2']['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover']
        );
    }

    protected function computePeriodThree()
    {
        $profiStatement = $this->statements['statement3']['metadataResults']['overAllResults']['profitStatements'];
        $balanceSheets = $this->statements['statement3']['metadataResults']['overAllResults']['balanceSheets'];

        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = ( (float) $profiStatement['sales'] / (float) $balanceSheets['total_assets']);
        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = ( (float) $profiStatement['cost_goods'] / (float) $balanceSheets['inventories']);


        $balanceSheets2 =  $this->statements['statement2']['metadataResults']['overAllResults']['balanceSheets'];


        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = ( (float) $profiStatement['sales'] / (float) $balanceSheets['total_assets']);
        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = ( (float) $profiStatement['cost_goods'] / (float) $balanceSheets['inventories']);

        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover'] = ((float) $balanceSheets2['tradereceivables'] + $balanceSheets['tradereceivables']) / 2;
        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover'] = (float) $profiStatement['sales'] / (((float) $balanceSheets2['tradereceivables'] + $balanceSheets['tradereceivables']) / 2);
        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days']  = (
            365 / $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover']
        );


        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover'] = ((float) $balanceSheets2['tradepayables'] + $balanceSheets['tradepayables']) / 2;
        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover'] = (float) $profiStatement['cost_goods'] / (((float) $balanceSheets2['tradepayables'] + $balanceSheets['tradepayables']) / 2);
        $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days']  = (
            365 / $this->statements['statement3']['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover']
        );
    }

    protected function save()
    {
        dd($this->statements);

        foreach ($this->statements as $statement) {

        }

        // $this->customer->statements()->updateOrCreate(
        // [
        //     'customer_id' => $this->customer->id,
        //     'period' => $customerStatement['period']
        // ],
        // [
        //     'metadataResults' => $customerStatement['metadataResults']
        // ]
        // );
    }
}
