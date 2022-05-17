<?php

namespace Best\Pro\Financial\Data;


class ProductivityDetail
{
    protected $arr = [];

    protected $financialStatements;

    protected $statementCount;

    protected $valueAdded;

    public function __construct($financialStatements)
    {
        $this->financialStatements = $financialStatements;

        $this->statementCount = count($financialStatements);

    }

    public function getData()
    {
        $this->getLabour();

        $this->getSPE();

        $this->getVASR();

        $this->getProfitMargin();

        $this->getPVAR();

        $this->getLCC();

        $this->getLCE();

        $this->getSDC();

        $this->getCI();

        $this->getCP();

        return $this->arr;
    }

    protected function getLabour()
    {
        $lists = [
            ['Labour Productivity', null, '2', '1', '0'],
            [
                null,
                null,
                "This measures the efficiency & effectiveness of employees in generating value added (VA)",
                null,
                null
            ],
            [null, null, null, null, null]
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $valueAdded = $this->financialStatements[$value]['metadataStatements']['Value Added'];

                    $numberOfStaff = $this->financialStatements[$value]['metadataStatements']['Number of Staff'];

                    $temp_data[] = $numberOfStaff != 0 ? round(($valueAdded / $numberOfStaff), 2) : 0;
                } else {
                    if ($value == 'Labour Productivity' || $value == null || $value == "This measures the efficiency & effectiveness of employees in generating value added (VA)") {
                        $temp_data[] = $value;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getSPE()
    {
        $lists = [
            ['Sales per Employee', null, '2', '1', '0'],
            [
                null,
                null,
                "This measures the efficiency & effectiveness of organisation's marketing strategy",
                null,
                null
            ],
            [null, null, null, null, null]
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $valueSales = $this->financialStatements[$value]['metadataStatements']['Sales'];

                    $numberOfStaff = $this->financialStatements[$value]['metadataStatements']['Number of Staff'];

                    $temp_data[] = $numberOfStaff != 0 ? round(($valueSales / $numberOfStaff), 2) : 0;
                } else {
                    if ($value == 'Sales per Employee' || $value == null || $value == "This measures the efficiency & effectiveness of organisation's marketing strategy") {
                        $temp_data[] = $value;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getVASR()
    {
        $lists = [
            ['Value Added-to-Sales ratio', null, '2', '1', '0'],
            [
                null,
                null,
                "This measures the proportion of sales created by the organisation over & above purchased materials and services",
                null,
                null
            ],
            [null, null, null, null, null]
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $valueAdded = $this->financialStatements[$value]['metadataStatements']['Value Added'];

                    $valueSales = $this->financialStatements[$value]['metadataStatements']['Sales'];

                    $temp_data[] = $valueSales != 0 ? round(($valueAdded / $valueSales), 2) : 0;
                } else {
                    if ($value == 'Value Added-to-Sales ratio' || $value == null  || $value == "This measures the proportion of sales created by the organisation over & above purchased materials and services") {
                        $temp_data[] = $value;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getProfitMargin()
    {
        $lists = [
            ['Profit Margin', null, '2', '1', '0'],
            [
                null,
                null,
                "This measures the proportion of sales after deducting all costs",
                null,
                null
            ],
            [null, null, null, null, null]
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $operatingLoss = $this->financialStatements[$value]['metadataResults']['overAllResults']['profitStatements']['operating_loss_or_profit'];

                    $valueSales = $this->financialStatements[$value]['metadataStatements']['Sales'];

                    $temp_data[] = $valueSales != 0 ? round(($operatingLoss / $valueSales),2)  : 0;
                } else {
                    if ($value == 'Profit Margin' || $value == null || $value == "This measures the proportion of sales after deducting all costs") {
                        $temp_data[] = $value;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getPVAR()
    {
        $lists = [
            ['Profit-to-Value Added ratio', null, '2', '1', '0'],
            [
                null,
                null,
                "This indicates the portion of operating profit allocated to the capital providers as a proportion of VA",
                null,
                null
            ],
            [null, null, null, null, null]
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $operatingLoss = $this->financialStatements[$value]['metadataResults']['overAllResults']['profitStatements']['operating_loss_or_profit'];

                    $valueAdded = $this->financialStatements[$value]['metadataStatements']['Value Added'];

                    $temp_data[] = $valueAdded != 0 ? round(($operatingLoss / $valueAdded), 2) : 0;
                } else {
                    if ($value == 'Profit-to-Value Added ratio' || $value == null || $value == "This indicates the portion of operating profit allocated to the capital providers as a proportion of VA") {
                        $temp_data[] = $value;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getLCC()
    {
        $lists = [
            ['Labour Cost Competitiveness', null, '2', '1', '0'],
            [
                null,
                null,
                "This measures the efficiency & effectiveness of the organisation in terms of its labour cost",
                null,
                null
            ],
            [null, null, null, null, null]
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $laborCosts = $this->financialStatements[$value]['metadataStatements']['Staff Salaries & Benefits'];

                    $valueAdded = $this->financialStatements[$value]['metadataStatements']['Value Added'];

                    $temp_data[] = $laborCosts != 0 ? round(($valueAdded / $laborCosts),2) : 0;
                } else {
                    if ($value == 'Labour Cost Competitiveness' || $value == null || $value == "This measures the efficiency & effectiveness of the organisation in terms of its labour cost") {
                        $temp_data[] = $value;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getLCE()
    {
        $lists = [
            ['Labour Cost per Employee', null, '2', '1', '0'],
            [
                null,
                null,
                "This indicates average remuneration per employee",
                null,
                null
            ],
            [null, null, null, null, null]
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $numberOfStaff = $this->financialStatements[$value]['metadataStatements']['Number of Staff'];

                    $laborCosts = $this->financialStatements[$value]['metadataStatements']['Staff Salaries & Benefits'];

                    $temp_data[] = $numberOfStaff != 0 ? round(($laborCosts / $numberOfStaff),2) : 0;
                } else {
                    if ($value == 'Labour Cost per Employee' || $value == null || $value == "This indicates average remuneration per employee") {
                        $temp_data[] = $value;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getSDC()
    {
        $lists = [
            ['Sales per Dollar of Capital', null, '2', '1', '0'],
            [
                null,
                null,
                "This measures the efficiency & effectiveness of fixed assets in the generation of sales",
                null,
                null
            ],
            [null, null, null, null, null]
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $valueSales = $this->financialStatements[$value]['metadataStatements']['Sales'];

                    $cost_goods= $this->financialStatements[$value]['metadataResults']['overAllResults']['profitStatements']['cost_goods'];

                    $temp_data[] = $cost_goods != 0 ? round(($valueSales / $cost_goods),2) : 0;
                } else {
                    if ($value == 'Sales per Dollar of Capital' || $value == null || $value == "This measures the efficiency & effectiveness of fixed assets in the generation of sales") {
                        $temp_data[] = $value;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getCI()
    {
        $lists = [
            ['Capital Intensity', null, '2', '1', '0'],
            [
                null,
                null,
                "This indicates the extent to which organisation is capital intensive",
                null,
                null
            ],
            [null, null, null, null, null]
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $numberOfStaff = $this->financialStatements[$value]['metadataStatements']['Number of Staff'];

                    $cost_goods= $this->financialStatements[$value]['metadataResults']['overAllResults']['profitStatements']['cost_goods'];

                    $temp_data[] = $numberOfStaff != 0 ? round(($cost_goods / $numberOfStaff),2) : 0;
                } else {
                    if ($value == 'Capital Intensity' || $value == null || $value == "This indicates the extent to which organisation is capital intensive") {
                        $temp_data[] = $value;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }

    protected function getCP()
    {
        $lists = [
            ['Capital Productivity', null, '2', '1', '0'],
            [
                null,
                null,
                "This measures the efficiency & effectiveness of fixed assets in the generation of VA",
                null,
                null
            ],
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $valueAdded = $this->financialStatements[$value]['metadataStatements']['Value Added'];

                    $cost_goods= $this->financialStatements[$value]['metadataResults']['overAllResults']['profitStatements']['cost_goods'];

                    $temp_data[] = $cost_goods != 0 ? round(($valueAdded / $cost_goods),2) : 0;
                } else {
                    if ($value == 'Capital Productivity' || $value == null || $value == "This measures the efficiency & effectiveness of fixed assets in the generation of VA") {
                        $temp_data[] = $value;
                    }
                }
            }

            array_push($this->arr, $temp_data);
        }
    }
}
