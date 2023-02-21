<?php

namespace Best\Pro\Financial\Data;

class SolvencyData
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
        $this->getDebtEquityRatio($this->financialStatements);

        $this->getDebtRatio($this->financialStatements);

        return $this->arr;
    }

    protected function getDebtEquityRatio($financialStatements) : void
    {
        $lists = [
            __('Debt to Equity Ratio') => null,
            __('Total Liabilities') => 'total_liabilities',
            __('Equity') => "Stockholders' Equity",
            __('The Debt to Equity ratio is:') => 'debt_to_equity_ratio',
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
                    if($list == 'total_liabilities') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list], 0, '',',');
                    }

                    if ($list == "Stockholder's Equity") {
                        $temp_data[] = number_format($financialStatement['metadataSheets'][$list], 0, '', ',');
                    }

                    if($list == 'debt_to_equity_ratio') {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['solvency'][$list];
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getDebtRatio($financialStatements)
    {
        $lists = [
            __('Debt Ratio') => null,
            __('Total Liabilities') => 'total_liabilities',
            __('Total Assets') => 'total_assets',
            __('The Debt Ratio')=> 'debt_ratio',
        ];

        foreach($lists as $key => $list) {

            $temp_data = [];

            if ($list == null) {

                for($i = 0; $i <= $this->statementsCount; $i++){
                    $item = $i == 0 ? 'Debt Ratio' : null;
                    $temp_data[] = $item;
                }
            } else {
                $temp_data[] = $key;

                foreach ($financialStatements as $financialStatement) {
                    if($list == 'total_liabilities' || $list == 'total_assets') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list], 0, '', ',');
                    }

                    if($list == 'debt_ratio') {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['solvency'][$list];
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }
}
