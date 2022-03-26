<?php

return [
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
                'score' => 0,
                'color' => '#F20000',
                'remarks' => 'Very Poor',
            ],
            'net_margin' => [
                'score' => 0,
                'color' => '#F20000',
                'remarks' => 'Very Poor',
            ],
            'roi' => [
                'score' => 0,
                'color' => '#F20000',
                'remarks' => 'Very Poor',
            ],
            'raw_materials' => [
                'score' => 0,
                'color' => '#F20000',
                'remarks' => 'Very Poor',
            ],
            'current_ratio' => [
                'score' => 0,
                'color' => '#F20000',
                'remarks' => 'Very Poor',
            ],
            'debt_ratio' =>[
                'score' => 0,
                'color' => '#F20000',
                'remarks' => 'Very Poor',
            ],
            'project_type' => '',
            'date' => '',
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
                0.079,
            ],
            'Poor' => [
                0.8,
                0.149,
            ],
            'Moderate' => [
                0.15,
                0.199
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
                0.499,
            ],
            'Poor' => [
                0.5,
                0.999,
            ],
            'Moderate' => [
                1,
                1.499
            ],
            'Good' => [
                1.5,
                1.999,
            ],
            'Excellent' => [
                2,
            ],
        ],
        'debt_ratio' => [
            'Very Poor' => [
                0.8,
                0.611,
            ],
            'Poor' => [
                0.6,
                0.511,
            ],
            'Moderate' => [
                0.5,
                0.211
            ],
            'Good' => [
                0.2,
                0.051,
            ],
            'Excellent' => [
                0.05,
            ],
        ],
        'roi' => [
            'Very Poor' => [
                0,
                0.0499,
            ],
            'Poor' => [
                0.05,
                0.099,
            ],
            'Moderate' => [
                0.1,
                0.1499
            ],
            'Good' => [
                0.15,
                0.249,
            ],
            'Excellent' => [
                0.25,
            ],
        ],
        'raw_materials' => [
            'Very Poor' => [
                0.5,
                0.411,
            ],
            'Poor' => [
                0.4,
                0.311,
            ],
            'Moderate' => [
                0.3,
                0.2511
            ],
            'Good' => [
                0.25,
                0.211,
            ],
            'Excellent' => [
                0.2,
            ],
        ]
    ],

    'industrial' => [
        'gross_margin' =>[
            'Very Poor' => [
                0.1,
                0.199,
            ],
            'Poor' => [
                0.2,
                0.2499,
            ],
            'Moderate' => [
                0.25,
                0.2999,
            ],
            'Good' => [
                0.3,
                0.399,
            ],
            'Excellent' => [
                0.4,
            ],
        ],
        'net_margin' => [
            'Very Poor' => [
                0.03,
                0.0499,
            ],
            'Poor' => [
                0.05,
                0.0699,
            ],
            'Moderate' => [
                0.07,
                0.0999,
            ],
            'Good' => [
                0.1,
                0.1499,
            ],
            'Excellent' => [
                0.15,
            ],
        ],
        'current_ratio' => [
            'Very Poor' => [
                0.5,
                0.7499,
            ],
            'Poor' => [
                0.75,
                0.999,
            ],
            'Moderate' => [
                1,
                1.2499
            ],
            'Good' => [
                1.25,
                1.799,
            ],
            'Excellent' => [
                1.8,
            ],
        ],
        'debt_ratio' => [
            'Very Poor' => [
                0.8,
                0.611,
            ],
            'Poor' => [
                0.6,
                0.511,
            ],
            'Moderate' => [
                0.5,
                0.211
            ],
            'Good' => [
                0.2,
                0.0511,
            ],
            'Excellent' => [
                0.05,
            ],
        ],
        'roi' => [
            'Very Poor' => [
                0,
                0.0299,
            ],
            'Poor' => [
                0.03,
                0.0599,
            ],
            'Moderate' => [
                0.06,
                0.099
            ],
            'Good' => [
                0.1,
                0.199,
            ],
            'Excellent' => [
                0.2,
            ],
        ],
        'raw_materials' => [
            'Very Poor' => [
                0.6,
                0.56,
            ],
            'Poor' => [
                0.55,
                0.46,
            ],
            'Moderate' => [
                0.45,
                0.36
            ],
            'Good' => [
                0.35,
                0.31,
            ],
            'Excellent' => [
                0.3,
            ],
        ],
    ],
];

