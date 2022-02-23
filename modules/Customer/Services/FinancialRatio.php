<?php

namespace Customer\Services;

use Customer\Models\Customer;
use Customer\Services\FinancialRatioInterface;

class FinancialRatio implements FinancialRatioInterface
{
    protected $customer;

    protected $overAllResults = [
        'profitStatements' => [],
        'balanceSheets' => []
    ];

    protected $ratioAnalysis = [
        'breakeven_point' => 0,
        'working_capital' => 0,
        'net_profit_margin' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.2,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'gross_profit_margin' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.1,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'raw_materials_margin' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.2,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'long_term_ratio' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.15,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'current_ratio_margin' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.2,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'roi' => [
            'percentage' => 0,
            'results' => 0,
            'score' => 0,
            'ratio' => 0,
            'weighting_ratio' => 0.15,
            'out_of' => 0,
            'status' => '',
            'color_status' => '',
        ],
        'overall_score' => [
            'score' => 0,
            'status' => '',
            'color_status' => 0,
            'total_rating' => 0,
            'total_out_of' => 0,
        ]
    ];

    public function compute(Customer $customer, $statements, $id)
    {
        $period = $statements['metadataStatements']['period'];
        $statement_id = $statements['id'];

        unset(
            $statements['metadataStatements']['period'],
            $statements['metadataSheets']['period'],
            $statements['metadataSheets']['Balance']
        );

        $customer->statements()->updateOrCreate(
            [
                'customer_id' => $id,
                'id' => $statement_id,
                'period' => $period,
            ],
            [
                'metadataStatements' => $statements['metadataStatements'],
                'metadataSheets' => $statements['metadataSheets'],
                'metadataResults' => array_merge(
                    $this->computeProfitStatement($statements['metadataStatements']),
                    $this->computeBalanceSheet($statements['metadataSheets'])
                )
            ]
        );
    }

    protected function computeProfitStatement($statements)
    {
        $this->ratioAnalysis['gross_profit_margin']['percentage'] = (($statements['Sales'] - $statements['Cost of Good Sold']) / $statements['Cost of Good Sold']) * 100;
    }


    protected function computeBalanceSheet($statements)
    {

    }
}
