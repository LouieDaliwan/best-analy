<?php

namespace Best\Pro\Financial\Data;

use Customer\Models\Customer;

class AdditionalRatioData
{
    protected $arr = [];

    protected $financialStatements;

    protected $statementsCount;

    protected $customer;

    public function __construct(Customer $customer, $financialStatements)
    {
        $this->financialStatements = $financialStatements;

        $this->statementsCount = count($financialStatements);

        $this->customer = $customer;
    }

    public function getData()
    {
        $this->getDebtEquityRatio($this->financialStatements);

        $this->getROI($this->financialStatements);

        return $this->arr;
    }

    protected function getDebtEquityRatio($financialStatements)
    {
        $lists = [
            'Raw Materials Margin' => null,
            'Raw Materials' => 'Raw Materials',
            'Turnover (T)' => 'sales',
            'The Debt to Equity ratio is:' => 'raw_materials_margin',
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

                    if($list == 'Raw Materials') {
                        $temp_data[] = number_format($financialStatement['metadataStatements'][$list], 2, ',', '');
                    }

                    if($list == 'sales') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 2, ',', '');
                    }

                    if($list == 'raw_materials_margin') {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['additional_ratios'][$list];
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getROI($financialStatements)
    {
        $lists = [
            'Return on Investment' => null,
            'Net (Loss)/Profits After Taxes' => 'net_loss_profit_after_taxes',
            'Investments' => 'investment_value',
            'The Debt ratio is:' => 'roi'
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

                    if($list == 'net_loss_profit_after_taxes') {
                        $temp_data[] = number_format($financialStatement['metadataResults']['overAllResults']['profitStatements'][$list], 2, ',', '');
                    }

                    if($list == 'investment_value') {
                        $temp_data[] = number_format($this->customer->detail->metadata[$list], 2, ',', '');
                    }

                    if($list == 'roi') {
                        $temp_data[] = $financialStatement['metadataResults']['ratioAnalysis']['additional_ratios'][$list];
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }
}
