<?php

namespace Best\Pro\Financial\Data;

class ProfitabilityData
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
        $this->getGrossProfit($this->financialStatements);

        $this->getOperatingProfit($this->financialStatements);

        $this->getNetProfit($this->financialStatements);

        $this->getROA($this->financialStatements);

        $this->getROE($this->financialStatements);

        $this->getEPS($this->financialStatements);

        $this->getOperatingRatio($this->financialStatements);

        return $this->arr;
    }


    protected function getGrossProfit($financialStatements) : void
    {
        $lists = [
            __('Gross Profit (GP) Margin') => null,
            __('Turnover') => 'sales',
            __('Direct Costs') => 'cost_goods',
            'empty' => null,
            __('The Gross Profit Margin is:') => 'gross_profit_margin',
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
                    if($list == 'sales' || $list == 'cost_goods') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'gross_profit_margin') {
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100 . '%';
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getOperatingProfit($financialStatements) : void
    {
        $lists = [
            __('Operating Profit Margin') => null,
            __('Operating (loss)/profit') => 'operating_loss_or_profit',
            __('Turnover') => 'sales',
            'empty' => null,
            __('The Operating Profit Margin is:') => 'operating_profit_margin',
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
                    if($list == 'operating_loss_or_profit' || $list == 'sales') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'operating_profit_margin') {
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100 . '%';
                    }
                }
            }
            array_push($this->arr, $temp_data);
        }
    }

    protected function getNetProfit($financialStatements) : void
    {
        $lists = [
            __('Net Profit Margin') => null,
            __('Net (Loss)/Profits After Taxes') => 'net_loss_profit_after_taxes',
            __('Turnover') => 'sales',
            'empty' => null,
            __('The Net Profit Margin is:') => 'net_profit_margin',
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
                    if($list == 'net_loss_profit_after_taxes' || $list == 'sales') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'net_profit_margin') {
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100 . '%';
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getROA($financialStatements) : void
    {
        $lists = [
            __('Return on Assets (ROA)') => null,
            __('Net (Loss)/Profits After Taxes') => 'net_loss_profit_after_taxes',
            __('Total Assets') => 'total_assets',
            'empty' => null,
            __('The Return on Assets is:') => 'return_on_assets',
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
                    if($list == 'net_loss_profit_after_taxes') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'total_assets') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list], 0, '', ',');
                    }

                    if($list == 'return_on_assets') {
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100 . '%';
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getROE($financialStatements)
    {
        $lists = [
            __('Return on Equity (ROE)') => null,
            __('Net (Loss)/Profits After Taxes') => 'net_loss_profit_after_taxes',
            __("Stockholders' Equity") => 'stockholdersequity',
            'empty' => null,
            __('The Return on Equity is:') => 'return_on_equity',
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
                    if($list == 'net_loss_profit_after_taxes') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'stockholdersequity') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list], 0, '', ',');
                    }

                    if($list == 'return_on_equity') {
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100 . '%';
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getEPS($financialStatements)
    {
        $lists = [
            __('Earnings Per Share (EPS)') => null,
            __("Earnings Available to Common Stockholders'") => 'net_loss_profit_after_taxes',
            __('Common Shares Outstanding') => 'commonsharesoutstanding',
            'empty' => null,
            __('The Earnings per Share are:') => 'earnings_per_share',
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
                    if($list == 'net_loss_profit_after_taxes') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'commonsharesoutstanding') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list], 0, '', ',');
                    }

                    if($list == 'earnings_per_share') {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100 . '%';
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getOperatingRatio($financialStatements)
    {
        $lists = [
            __('Operating Ratio') => null,
            __("Operating expenses (OE)") => 'operating_expenses',
            __('Turnover (T)') => 'sales',
            'empty' => null,
            'empty1' => null,
            __('The Operating Ratio is:') => 'operating_ratio'
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
                    if($list == 'operating_expenses' || $list == 'sales') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 0, '', ',');
                    }

                    if($list == 'operating_ratio') {
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }
}
