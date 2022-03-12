<?php

namespace Customer\Models\Attributes;

class Efficiency
{
    protected $customer;

    protected $statements;

    protected $statement1;

    protected $statement2;

    protected $statement3;

    public function __construct($customer)
    {
        $this->customer = $customer;

        $this->statements = $this->customer
        ->statements()
        ->latest('period')
        ->take(3)
        ->get()
        ->toArray();

        $this->statement1 = $this->statements[2];

        $this->statement2 = $this->statements[1];

        $this->statement3 = $this->statements[0];
    }

    public function compute() : void
    {
        $this->computePeriodOne();

        $this->computePeriodTwo();

        $this->computePeriodThree();
    }

    protected function computePeriodOne()
    {
        //TODO optimize
        $profiStatement = $this->statement1['metadataResults']['overAllResults']['profitStatements'];
        $balanceSheets =  $this->statement1['metadataResults']['overAllResults']['balanceSheets'];

        $this->statement1['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = (
            (float) $profiStatement['sales'] / (float) $balanceSheets['total_assets']
        );
        $this->statement1['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = (
            (float) $profiStatement['cost_goods'] / (float) $balanceSheets['inventories']
        );

        $this->save($this->statement1);
    }

    protected function computePeriodTwo()
    {
        $profiStatement = $this->statement2['metadataResults']['overAllResults']['profitStatements'];
        $balanceSheets =  $this->statement2['metadataResults']['overAllResults']['balanceSheets'];

        $balanceSheets1 =  $this->statement1['metadataResults']['overAllResults']['balanceSheets'];

        $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = (
            (float) $profiStatement['sales'] / (float) $balanceSheets['total_assets']
        );
        $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = (
            (float) $profiStatement['cost_goods'] / (float) $balanceSheets['inventories']
        );

        $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover'] = (
            (float) $balanceSheets1['tradereceivables'] + $balanceSheets['tradereceivables']
        ) / 2;
        $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover'] =
        (float) $profiStatement['sales'] / (((float) $balanceSheets1['tradereceivables'] + $balanceSheets['tradereceivables']) / 2);

        $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days']  = (
            365 / $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover']
        );


        $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover'] = ((float) $balanceSheets1['tradepayables'] + $balanceSheets['tradepayables']) / 2;

        $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover'] =
        (float) $profiStatement['cost_goods'] / (((float) $balanceSheets1['tradepayables'] + $balanceSheets['tradepayables']) / 2);

        $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days']  = (
            365 / $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover']
        );

        $this->save($this->statement2);
    }

    protected function computePeriodThree()
    {
        $profiStatement = $this->statement3['metadataResults']['overAllResults']['profitStatements'];
        $balanceSheets = $this->statement3['metadataResults']['overAllResults']['balanceSheets'];

        $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = ( (float) $profiStatement['sales'] / (float) $balanceSheets['total_assets']);
        $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = ( (float) $profiStatement['cost_goods'] / (float) $balanceSheets['inventories']);


        $balanceSheets2 =  $this->statement2['metadataResults']['overAllResults']['balanceSheets'];


        $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'] = ( (float) $profiStatement['sales'] / (float) $balanceSheets['total_assets']);
        $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'] = ( (float) $profiStatement['cost_goods'] / (float) $balanceSheets['inventories']);

        $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover'] = ((float) $balanceSheets2['tradereceivables'] + $balanceSheets['tradereceivables']) / 2;
        $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover'] = (float) $profiStatement['sales'] / (((float) $balanceSheets2['tradereceivables'] + $balanceSheets['tradereceivables']) / 2);
        $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days']  = (
            365 / $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['trade_receivable_turnover']
        );


        $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover'] = ((float) $balanceSheets2['tradepayables'] + $balanceSheets['tradepayables']) / 2;
        $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover'] = (float) $profiStatement['cost_goods'] / (((float) $balanceSheets2['tradepayables'] + $balanceSheets['tradepayables']) / 2);
        $this->statement3['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days']  = (
            365 / $this->statement2['metadataResults']['ratioAnalysis']['efficiency']['trade_payable_turnover']
        );

        $this->save($this->statement3);
    }

    protected function save($customerStatement)
    {
        $this->customer->statements()->updateOrCreate(
        [
            'customer_id' => $this->customer->id,
            'period' => $customerStatement['period']
        ],
        [
            'metadataResults' => $customerStatement['metadataResults']
        ]
        );
    }
}
