<?php

namespace Best\Pro\Financial\Data;

class LiquidityData
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
        $this->getCurrentRatio($this->financialStatements);

        $this->getCashRatio($this->financialStatements);

        $this->getWorkingCapital($this->financialStatements);

        return $this->arr;
    }

    protected function getCurrentRatio($financialStatements) : void
    {
        $lists = [
            __('Current Ratio') => null,
            __('Current Assets (CA)') => 'current_assets',
            __('Current Liabilities (CL)') => 'current_liabilities',
            'empty' => null,
            'empty1' => null,
            __('The Current Ratio is:') => 'current_ratio',
            'empty2' => null,
        ];

        foreach($lists as $key => $list) {

            $temp_data = [];

            if ($list == null) {
                $item = $key == 'empty' || $key == 'empty1' || $key == 'empty2' ? null : $key;

                $temp_data[] = $item;

                for ($i = 1; $i <= $this->statementsCount; $i++) {
                    $itemFinVal = $key == 'empty1' && $i != 0 ? 'CA : CL' : null;
                    $temp_data[] = $itemFinVal;
                }
            } else {
                $temp_data[] = $key;

                foreach ($financialStatements as $financialStatement) {
                    if($list == 'current_assets' || $list == 'current_liabilities') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list], 0, '', ',');
                    }

                    if($list == 'current_ratio') {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['liquidity'][$list];
                    }
                }
            }
            array_push($this->arr, $temp_data);
        }
    }

    protected function getCashRatio($financialStatements) : void
    {
        $lists = [
            __('Cash Ratio') => null,
            __('Cash and cash equivalents (C&CE)') => 'cash',
            __('Current Liabilities (CL)') => 'current_liabilities',
            'empty' => null,
            'empty1' => null,
            __('The Cash Ratio is:') => 'cash_ratio',
            'empty2' => null,

        ];

        foreach($lists as $key => $list) {

            $temp_data = [];

            if ($list == null) {
                $item = $key == 'empty' || $key == 'empty1' || $key == 'empty2' ? null : $key;

                $temp_data[] = $item;

                for ($i = 1; $i <= $this->statementsCount; $i++) {
                    $itemFinVal = $key == 'empty1' && $i != 0 ? 'C&CE:L' : null;
                    $temp_data[] = $itemFinVal;
                }
            } else {
                $temp_data[] = $key;

                foreach ($financialStatements as $financialStatement) {
                    if($list == 'cash' || $list == 'current_liabilities') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list], 0, '', ',');
                    }

                    if($list == 'cash_ratio') {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['liquidity'][$list];
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getWorkingCapital($financialStatements)
    {
        $lists = [
            __('Working Capital Turnover') => null,
            __('Current Asset') => 'current_assets',
            __('Current Liabilities (CL)') => 'current_liabilities',
            __('Recommended Current Ratio') => 1.50,
            'empty' => null,
            __('The Working Capital is:') => 'working_capital',
            'empty1' => null,
            __('The Working Capital Turnover is:') => 'working_capital_turnover'
        ];

        foreach($lists as $key => $list) {

            $temp_data = [];

            if ($list == null || $list == 1.50) {
                if ($key != 'Recommended Current Ratio') {
                    $item = $key == 'empty' || $key == 'empty1' ? null : $key;
                } else {
                    $item = $key;
                }

                $temp_data[] = $item;

                for ($i = 1; $i <= $this->statementsCount; $i++) {
                    $itemFinVal = $key == 'Recommended Current Ratio' && $i != 0 ? 1.50 : null;
                    $temp_data[] = $itemFinVal;
                }
            } else {
                $temp_data[] = $key;

                foreach ($financialStatements as $financialStatement) {

                    if($list == 'current_assets' || $list == 'current_liabilities') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list], 0, '', ',');
                    }

                    if($list == 'working_capital' || $list == 'working_capital_turnover') {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['liquidity'][$list];
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }
}
