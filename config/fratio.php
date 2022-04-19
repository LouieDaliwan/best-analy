<?php

return [
    'ratings_format' => [
        'smeRatings' => [
            'bspi' => [
                'label' => "BSPI",
                'score' => 0,
                'code' => 'business-sustainability',
                'id' => 2,
            ],
            'fmpi' => [
                'label' => "FMPI",
                'score' => 0,
                'code' => 'financial-management',
                'id' => 1,
            ],
            'pmpi' => [
                'label' => "PMPI",
                'score' => 0,
                'code' => 'productivity-management',
                'id' => 3
            ],
            'hrpi' => [
                'label' => "HRPI",
                'score' => 0,
                'code' => 'human-resource',
                'id' => 4,
            ],
            'sdmi' => [
                'label' => "5th Module",
                'score' => 0,
                'code' => 'sdmi',
                'id' => 5
            ],
            'financial_score' => [
                'label' => 'Financial Score',
                'score' => 0,
                'code' => 'financial-score',
                'id' => 'empty'
            ],
        ],
        'answered_index' => 0,
        'overall_score' => 0.00,
        'results' => 'Incomplete'
    ],
    'format' => [
        'profitability' => [
            'net_profit_margin' => 0,
            'gross_profit_margin' => 0,
            'operating_profit_margin' => 0,
            'return_on_assets' => 0,
            'return_on_equity' => 0,
            'earnings_per_share' => 0,
            'operating_ratio' => 0,
        ],
        'liquidity' => [
            'current_ratio' => 0,
            'cash_ratio' => 0,
            'working_capital' => 0,
            'recommended_working_capital' => 0,
            'working_capital_turnover' => 0,
        ],
        'efficiency' => [
            'trade_receivable_turnover' => 0,
            'avg_trade_receivable_turnover' => 0,
            'avg_trade_receivable_turnover_days' => 0,
            'trade_payable_turnover' => 0,
            'avg_trade_payable_turnover' => 0,
            'avg_trade_payable_turnover_days' => 0,
            'assets_turnover_ratio' => 0,
            'inventory_turnover_ratio' => 0,
        ],
        'solvency' => [
            'debt_to_equity_ratio' => 0,
            'debt_ratio' => 0,
        ],
        'productivity' => [
            'labour_cost_comptetitiveness' => 0,
        ],
        'additional_ratios' => [
            'raw_materials_margin' => 0,
            'roi' => 0,
        ],
        'dashboard' => [
            'gross_margin' => [
                'score' => 'NA',
                'color' => '#828282',
                'remarks' => 'NA',
            ],
            'net_margin' => [
                'score' => 'NA',
                'color' => '#828282',
                'remarks' => 'NA',
            ],
            'roi' => [
                'score' => 'NA',
                'color' => '#828282',
                'remarks' => 'NA',
            ],
            'raw_materials' => [
                'score' => 'NA',
                'color' => '#828282',
                'remarks' => 'NA',
            ],
            'current_ratio' => [
                'score' => 'NA',
                'color' => '#828282',
                'remarks' => 'NA',
            ],
            'debt_ratio' =>[
                'score' => 'NA',
                'color' => '#828282',
                'remarks' => 'NA',
            ],
            'project_type' => '',
            'date' => '',
            'financial_score' => 0,
        ],
    ],
    'non_industrial' => [
        'gross_margin' =>[
            'Very Poor' => [
                0.3,
                0.39
            ],
            'Poor' => [
                0.4,
                0.49,
            ],
            'Moderate' => [
                0.5,
                0.64
            ],
            'Good' => [
                0.65,
                0.79
            ],
            'Excellent' => [
                0.8
            ]
        ],
        'net_margin' => [
            'Very Poor' => [
                0.05,
                0.07,
            ],
            'Poor' => [
                0.08,
                0.14,
            ],
            'Moderate' => [
                0.15,
                0.19
            ],
            'Good' => [
                0.2,
                0.29,
            ],
            'Excellent' => [
                0.3,
            ],
        ],
        'current_ratio' => [
            'Very Poor' => [
                0.3,
                0.49,
            ],
            'Poor' => [
                0.5,
                0.99,
            ],
            'Moderate' => [
                1,
                1.49
            ],
            'Good' => [
                1.5,
                1.99,
            ],
            'Excellent' => [
                2,
            ],
        ],
        'debt_ratio' => [
            'Excellent' => [
                0.05,
            ],
            'Good' => [
                0.06,
                0.2,
            ],
            'Moderate' => [
                0.21,
                0.5,  
            ],
            'Poor' => [
                0.51,
                0.6,
            ],
            'Very Poor' => [
                0.61,
                0.8,                
            ],
        ],
        'roi' => [
            'Very Poor' => [
                0,
                0.04,
            ],
            'Poor' => [
                0.05,
                0.09,
            ],
            'Moderate' => [
                0.1,
                0.14
            ],
            'Good' => [
                0.15,
                0.24,
            ],
            'Excellent' => [
                0.25,
            ],
        ],
        'raw_materials' => [
            'Excellent' => [
                0.2,
            ],
            'Good' => [
                0.25,
                0.21,
            ],
            'Moderate' => [
                0.3,
                0.26
            ],
            'Poor' => [
                0.4,
                0.31,
            ],
            'Very Poor' => [
                0.5,
                0.41,
            ],
        ]
    ],

    'industrial' => [
        'gross_margin' =>[
            'Very Poor' => [
                0.1,
                0.19,
            ],
            'Poor' => [
                0.2,
                0.24,
            ],
            'Moderate' => [
                0.25,
                0.29,
            ],
            'Good' => [
                0.3,
                0.39,
            ],
            'Excellent' => [
                0.4,
            ],
        ],
        'net_margin' => [
            'Very Poor' => [
                0.03,
                0.04,
            ],
            'Poor' => [
                0.05,
                0.06,
            ],
            'Moderate' => [
                0.07,
                0.09,
            ],
            'Good' => [
                0.1,
                0.14,
            ],
            'Excellent' => [
                0.15,
            ],
        ],
        'current_ratio' => [
            'Very Poor' => [
                0.5,
                0.74,
            ],
            'Poor' => [
                0.75,
                0.99,
            ],
            'Moderate' => [
                1,
                1.24
            ],
            'Good' => [
                1.25,
                1.79,
            ],
            'Excellent' => [
                1.8,
            ],
        ],
        'debt_ratio' => [
            'Excellent' => [
                0.05,
            ],
            'Good' => [
                0.06,
                0.2,
                            ],
            'Moderate' => [
                0.21,
                0.5,  
            ],
            'Poor' => [
                0.51,
                0.6,
            ],
            'Very Poor' => [
                0.61,
                0.8,                
            ],
        ],
        'roi' => [
            'Very Poor' => [
                0,
                0.02,
            ],
            'Poor' => [
                0.03,
                0.05,
            ],
            'Moderate' => [
                0.06,
                0.09
            ],
            'Good' => [
                0.1,
                0.19,
            ],
            'Excellent' => [
                0.2,
            ],
        ],
        'raw_materials' => [
            'Excellent' => [
                0.3,
            ],
            'Good' => [
                0.31,
                0.35,
            ],
            'Moderate' => [
                0.36,
                0.45,                
            ],
            'Poor' => [
                0.55,
                0.46,
            ],
            'Very Poor' => [
                0.56,
                0.6,
            ],
        ],
    ],
    'score_descriptor' => [
        'N/A' => 0,
        'Very Poor' => 1,
        'Poor' => 2,
        'Moderate' => 3,
        'Good' => 4,
        'Excellent' => 5, 
    ]
];

