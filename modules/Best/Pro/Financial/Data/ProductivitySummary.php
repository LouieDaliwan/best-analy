<?php

namespace Best\Pro\Financial\Data;

class ProductivitySummary
{
    protected $arr = [];

    protected $financialStatements;

    protected $statementsCount;

    public function __construct($financialStatements)
    {
        $this->financialStatements = $financialStatements;

        $this->statementsCount = count($financialStatements);
    }

    public function getSummary()
    {
        $this->getPeriod();

        //to be optimize
        $this->arr[] = [null, null, null, null, null];

        $this->arr[] = [null, null, null, null, null];

        $this->getValueAdded();

        $this->getNumberStaff();

        $this->getSales();

        $this->operatingTax();

        $this->labourCost();

        $this->fixedAssets();

        return $this->arr;
    }

    protected function getPeriod() : void
    {
        $lists = [null, null, '2', '1', '0'];

        $temp_data = [];

        foreach ($lists as $list) {
            if($list == null) {
                $temp_data[] = $list;
            }

            if($list != null){
                if(isset($this->financialStatements[$list])){
                    $temp_data[] = $this->financialStatements[$list]['period'];
                }
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function getValueAdded() : void
    {
        $lists = ['Value Added', null, '2', '1', '0'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Value Added') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Value Added'){
                if(isset($this->financialStatements[$list])){
                    $temp_data[] = $this->financialStatements[$list]['metadataStatements']['Value Added'];
                }
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function getNumberStaff() : void
    {
        $lists = ['Number of employees', null, '2', '1', '0'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Number of employees') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Number of employees'){
                if(isset($this->financialStatements[$list])){
                    $temp_data[] = $this->financialStatements[$list]['metadataStatements']['Number of Staff'];
                }
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function getSales() : void
    {
        $lists = ['Sales', null, '2', '1', '0'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Sales') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Sales'){
                if(isset($this->financialStatements[$list])){
                    $temp_data[] = $this->financialStatements[$list]['metadataStatements']['Sales'];
                }
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function operatingTax()
    {
        $lists = ['Operating Profit (before interest & tax)', null, '2', '1', '0'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Operating Profit (before interest & tax)') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Operating Profit (before interest & tax)'){
                if(isset($this->financialStatements[$list])){
                    $temp_data[] = $this->financialStatements[$list]['metadataResults']['overAllResults']['profitStatements']['operating_loss_or_profit'];
                }
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function labourCost()
    {
        $lists = ['Labour cost', null, '2', '1', '0'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Labour cost') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Labour cost'){
                if(isset($this->financialStatements[$list])){
                    $temp_data[] = $this->financialStatements[$list]['metadataStatements']['Staff Salaries & Benefits'];
                }
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function fixedAssets()
    {
        $lists = ['Fixed Assets at Net Book Value', null, '2', '1', '0'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Fixed Assets at Net Book Value') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Fixed Assets at Net Book Value'){
                if(isset($this->financialStatements[$list])){
                    $temp_data[] = $this->financialStatements[$list]['metadataResults']['overAllResults']['profitStatements']['cost_goods'];
                }
            }
        }

        array_push($this->arr, $temp_data);
    }
}
