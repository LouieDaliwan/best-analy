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
            'Debt to Equity Ratio' => null,
            'Total Liabilities' => 'total_liabilities',
            'The Debt to Equity ratio is:' => 'debt_to_equity_ratio',
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
                        $temp_data[] = $financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list];
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
            'Debt Ratio' => null,
            'Total Liabilities' => 'total_liabilities',
            'Total Assets' => 'total_assets',
            'The Debt Ratio' => 'debt_ratio',
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
                        $temp_data[] = $financialStatement['metadataResults']['overAllResults']['balanceSheets'][$list];
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
