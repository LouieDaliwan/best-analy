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
            'Gross Profit (GP) Margin' => null,
            'Turnover' => 'sales',
            'Direct Costs' => 'cost_goods',
            'empty' => null,
            'The Gross Profit Margin is:' => 'gross_profit_margin',
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
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 2, '', ',');
                    }

                    if($list == 'gross_profit_margin') {
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getOperatingProfit($financialStatements) : void
    {
        $lists = [
            'Operating Profit Margin' => null,
            'Operating (loss)/profit' => 'operating_loss_or_profit',
            'Turnover' => 'sales',
            'empty' => null,
            'The Operating Profit Margin is:' => 'operating_profit_margin',
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
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 2, '', ',');
                    }

                    if($list == 'operating_profit_margin') {
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100;
                    }
                }
            }
            array_push($this->arr, $temp_data);
        }
    }

    protected function getNetProfit($financialStatements) : void
    {
        $lists = [
            'Net Profit Margin' => null,
            'Net (Loss)/Profits After Taxes' => 'net_loss_profit_after_taxes',
            'Turnover' => 'sales',
            'empty' => null,
            'The Net Profit Margin is:' => 'net_profit_margin',
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
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 2, '', ',');
                    }

                    if($list == 'net_profit_margin') {
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getROA($financialStatements) : void
    {
        $lists = [
            'Return on Assets (ROA)' => null,
            'Net (Loss)/Profits After Taxes' => 'net_loss_profit_after_taxes',
            'Total Assets' => 'total_assets',
            'empty' => null,
            'The Return on Assets is:' => 'return_on_assets',
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
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getROE($financialStatements)
    {
        $lists = [
            'Return on Equity (ROE)' => null,
            'Net (Loss)/Profits After Taxes' => 'net_loss_profit_after_taxes',
            "Stockholders' Equity" => 'stockholdersequity',
            'empty' => null,
            'The Return on Equity is:' => 'return_on_equity',
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
                        $temp_data[] = (float) $financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list] * 100;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getEPS($financialStatements)
    {
        $lists = [
            'Earnings Per Share (EPS)' => null,
            "Earnings Available to Common Stockholders'" => 'net_loss_profit_after_taxes',
            'Common Shares Outstanding' => 'commonsharesoutstanding',
            'empty' => null,
            'The Earnings per Share are:' => 'earnings_per_share',
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
                        $temp_data[] = number_format($financialStatement['metadataResults']['ratioAnalysis']['profitability'][$list], 0 , '', ',');
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getOperatingRatio($financialStatements)
    {
        $lists = [
            'Operating Ratio' => null,
            "Operating expenses (OE)" => 'operating_expenses',
            'Turnover (T)' => 'sales',
            'empty' => null,
            'empty1' => null,
            'The Operating Ratio is:' => 'operating_ratio'
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
