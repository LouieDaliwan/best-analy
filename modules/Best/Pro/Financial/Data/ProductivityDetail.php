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

                    $temp_data[] = $numberOfStaff != 0 ? ($valueAdded / $numberOfStaff) : 0;
                } else {
                    $temp_data[] = $value;
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

                    $temp_data[] = $numberOfStaff != 0 ? ($valueSales / $numberOfStaff) : 0;
                } else {
                    $temp_data[] = $value;
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

                    $temp_data[] = $valueSales != 0 ? ($valueAdded / $valueSales) : 0;
                } else {
                    $temp_data[] = $value;
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

                    $temp_data[] = $valueSales != 0 ? ($operatingLoss / $valueSales) : 0;
                } else {
                    $temp_data[] = $value;
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

                    $temp_data[] = $valueAdded != 0 ? ($operatingLoss / $valueAdded) : 0;
                } else {
                    $temp_data[] = $value;
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

                    $temp_data[] = $laborCosts != 0 ? ($valueAdded / $valueAdded) : 0;
                } else {
                    $temp_data[] = $value;
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

                    $temp_data[] = $numberOfStaff != 0 ? ($laborCosts / $numberOfStaff) : 0;
                } else {
                    $temp_data[] = $value;
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

                    $temp_data[] = $cost_goods != 0 ? ($valueSales / $cost_goods) : 0;
                } else {
                    $temp_data[] = $value;
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

                    $temp_data[] = $numberOfStaff != 0 ? ($cost_goods / $numberOfStaff) : 0;
                } else {
                    $temp_data[] = $value;
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
            [null, null, null, null, null]
        ];

        foreach ($lists as $values) {

            $temp_data = [];

            foreach ($values as $value) {

                if (isset($this->financialStatements[$value])) {

                    $valueAdded = $this->financialStatements[$value]['metadataStatements']['Value Added'];

                    $cost_goods= $this->financialStatements[$value]['metadataResults']['overAllResults']['profitStatements']['cost_goods'];

                    $temp_data[] = $cost_goods != 0 ? ($valueAdded / $cost_goods) : 0;
                } else {
                    $temp_data[] = $value;
                }
            }

            array_push($this->arr, $temp_data);
        }
    }
}