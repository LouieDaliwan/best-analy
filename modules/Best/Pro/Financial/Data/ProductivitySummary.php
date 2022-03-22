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
        $lists = [null, null, '0', '1', '2'];

        $temp_data = [];

        foreach ($lists as $list) {
            if($list == null) {
                $temp_data[] = $list;
            }

            if($list != null){
                $temp_data[] = $this->financialStatements[$list]['period'];
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function getValueAdded() : void
    {
        $lists = ['Value Added', null, '0', '1', '2'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Value Added') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Value Added'){
                $temp_data[] = $this->financialStatements[$list]['metadataStatements']['Value Added'];
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function getNumberStaff() : void
    {
        $lists = ['Number of employees', null, '0', '1', '2'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Number of employees') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Number of employees'){
                $temp_data[] = $this->financialStatements[$list]['metadataStatements']['Number of Staff'];
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function getSales() : void
    {
        $lists = ['Sales', null, '0', '1', '2'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Sales') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Sales'){
                $temp_data[] = $this->financialStatements[$list]['metadataStatements']['Sales'];
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function operatingTax()
    {
        $lists = ['Operating Profit (before interest & tax)', null, '0', '1', '2'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Operating Profit (before interest & tax)') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Operating Profit (before interest & tax)'){
                $temp_data[] = $this->financialStatements[$list]['metadataResults']['overAllResults']['profitStatements']['operating_loss_or_profit'];
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function labourCost()
    {
        $lists = ['Labour cost', null, '0', '1', '2'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Labour cost') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Labour cost'){
                $temp_data[] = $this->financialStatements[$list]['metadataStatements']['Staff Salaries & Benefits'];
            }
        }

        array_push($this->arr, $temp_data);
    }

    protected function fixedAssets()
    {
        $lists = ['Fixed Assets at Net Book Value', null, '0', '1', '2'];

        $temp_data = [];
        foreach ($lists as $list) {
            if($list == null || $list == 'Fixed Assets at Net Book Value') {
                $temp_data[] = $list;
            }

            if($list != null && $list != 'Fixed Assets at Net Book Value'){
                $temp_data[] = $this->financialStatements[$list]['metadataResults']['overAllResults']['profitStatements']['cost_goods'];
            }
        }

        array_push($this->arr, $temp_data);
    }
}
