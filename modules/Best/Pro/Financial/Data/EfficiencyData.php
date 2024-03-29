<?php

namespace Best\Pro\Financial\Data;

class EfficiencyData
{
    protected $arr = [];

    protected $financialStatements;

    protected $statementsCount;

    public function __construct($financialStatements)
    {
        $this->financialStatements = $financialStatements;

        $this->statementsCount = count($financialStatements);
    }

    public function getData()
    {
        $this->getReceivables($this->financialStatements);

        $this->getPayables($this->financialStatements);

        $this->getAssets($this->financialStatements);

        $this->getInventory($this->financialStatements);


        return $this->arr;
    }

    protected function getReceivables($financialStatements) : void
    {
        $lists = [
            'Trade Receivable Turnover' => null,
            'Turnover (T)' => 'sales',
            'Average Trade Receivable' => 'avg_trade_receivable_turnover',
            'The Trade Receivables turnover is:' => 'trade_receivable_turnover',
            'empty' => null,
            'Avg. Trade Receivables Turnover(days)' => 'avg_trade_receivable_turnover_days',
            'empty1' => null,
        ];

        foreach($lists as $key => $list) {

            $temp_data = [];

            if ($list == null) {
                $item1 = $key == 'empty' || $key == 'empty1' ? null : $key;

                for($i = 0; $i <= $this->statementsCount; $i++){
                    $item = $i == 0 ? $item1 : null;
                    $temp_data[] = $item;
                }
            } else {
                $temp_data[] = $key;

                foreach ($financialStatements as $financialStatement) {
                    if($list == 'sales') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'avg_trade_receivable_turnover' || $list == 'trade_receivable_turnover' || $list == 'avg_trade_receivable_turnover_days') {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['efficiency'][$list];
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getPayables($financialStatements)
    {
        $lists = [
            __('Trade Payable Turnover') => null,
            __('COGS') => 'cost_goods',
            __('Average Trade Payable') => 'avg_trade_payable_turnover',
            __('The Trade Payable turnover is:') => 'trade_payable_turnover',
            'empty' => null,
            __('Avg. Trade Payable Turnover (days)') => 'avg_trade_payable_turnover_days',
            'empty1' => null,
        ];

        foreach($lists as $key => $list) {

            $temp_data = [];

            if ($list == null) {
                $item1 = $key == 'empty' || $key == 'empty1' ? null : $key;

                for($i = 0; $i <= $this->statementsCount; $i++){
                    $item = $i == 0 ? $item1 : null;
                    $temp_data[] = $item;
                }
            } else {
                $temp_data[] = $key;

                foreach ($financialStatements as $financialStatement) {
                    if($list == 'cost_goods') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'avg_trade_payable_turnover' || $list == 'trade_payable_turnover' || $list == 'avg_trade_payable_turnover_days') {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['efficiency'][$list];
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getAssets($financialStatements)
    {
        $lists = [
            __('Asset Turnover Ratio') => null,
            __('Turnover (T)') => 'sales',
            __('Total Assets') => 'total_assets',
            __('The Asset Turnover ratio is:') => 'assets_turnover_ratio',
            'empty' => null,
        ];

        foreach($lists as $key => $list) {

            $temp_data = [];

            if ($list == null) {
                $item1 = $key == 'empty' ? null : $key;

                for($i = 0; $i <= $this->statementsCount; $i++){
                    $item = $i == 0 ? $item1 : null;
                    $temp_data[] = $item;
                }
            } else {
                $temp_data[] = $key;

                foreach ($financialStatements as $financialStatement) {
                    if($list == 'sales') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'total_assets') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list], '2', '', ',');
                    }

                    if($list == 'assets_turnover_ratio' ) {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['efficiency'][$list];
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getInventory($financialStatements)
    {
        $lists = [
            __('Inventory Turnover Ratio') => null,
            __('COGS') => 'cost_goods',
            __('Inventory') => 'inventories',
            __('The Inventory Turnover ratio is:') => 'inventory_turnover_ratio',
        ];

        foreach($lists as $key => $list) {

            $temp_data = [];

            if ($list == null) {
                $item1 = $key == 'empty' ? null : $key;

                for($i = 0; $i <= $this->statementsCount; $i++){
                    $item = $i == 0 ? $item1 : null;
                    $temp_data[] = $item;
                }
            } else {
                $temp_data[] = $key;

                foreach ($financialStatements as $financialStatement) {
                    if($list == 'cost_goods') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'inventories') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list], 0, '', ',');
                    }

                    if($list == 'inventory_turnover_ratio' ) {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['efficiency'][$list];
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }
}
