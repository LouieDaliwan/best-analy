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
            'trade_payable_turnover' => 0,
            'avg_trade_payable_turnover' => 0,
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
                'color' => '',
            ],
            'net_margin' => [
                'score' => 0,
                'color' => '',
            ],
            'roi' => [
                'score' => 0,
                'color' => '',
            ],
            'raw_materials' => [
                'score' => 0,
                'color' => '',
            ],
            'current_ratio' => [
                'score' => 0,
                'color' => '',
            ],
            'debt_ratio' =>[
                'score' => 0,
                'color' => '',
            ],
            'project_type' => '',
            'date' => '',
        ],
    ],
    'non_industrial' => [
        'gross_margin' =>[
            '0.3'  => 'Very Poor',
            '0.4'  => 'Poor',
            '0.5'  => 'Moderate',
            '0.65' => 'Good',
            '0.8'  => 'Excellent'
        ],
        'net_margin' => [
            '0.05' => 'Very Poor',
            '0.08' => 'Poor',
            '0.15' => 'Moderate',
            '0.2'  => 'Good',
            '0.3'  => 'Excellent'
        ],
        'current_ratio' => [
            '0.3'  => 'Very Poor',
            '0.5'  => 'Poor',
            '1'    => 'Moderate',
            '1.5'  => 'Good',
            '2'    => 'Excellent'
        ],
        'debt_ratio' => [
            '0.8'  => 'Very Poor',
            '0.6'  => 'Poor',
            '0.5'  => 'Moderate',
            '0.2'  => 'Good',
            '0.05' => 'Excellent'
        ],
        'roi' => [
            '0'    => 'Very Poor',
            '0.05' => 'Poor',
            '0.1'  => 'Moderate',
            '0.15' => 'Good',
            '0.25' => 'Excellent'
        ],
        'raw_materials' => [
            '0.5'  => 'Very Poor',
            '0.4'  => 'Poor',
            '0.3'  => 'Moderate',
            '0.25' => 'Good',
            '0.2'  => 'Excellent'
        ]
    ],

    'industrial' => [
        'gross_margin' =>[
            '0.1'  => 'Very Poor',
            '0.2'  => 'Poor',
            '0.25' => 'Moderate',
            '0.3'  => 'Good',
            '0.4'  => 'Excellent'
        ],
        'net_margin' => [
            '0.03' => 'Very Poor',
            '0.05' => 'Poor',
            '0.07' => 'Moderate',
            '0.1'  => 'Good',
            '0.15' => 'Excellent'
        ],
        'current_ratio' => [
            '0.5'  => 'Very Poor',
            '0.75' => 'Poor',
            '1'    => 'Moderate',
            '1.25' => 'Good',
            '1.8'  => 'Excellent'
        ],
        'debt_ratio' => [
            '0.8'  => 'Very Poor',
            '0.6'  => 'Poor',
            '0.5'  => 'Moderate',
            '0.2'  => 'Good',
            '0.05' => 'Excellent'
        ],
        'roi' => [
            '0'    => 'Very Poor',
            '0.03' => 'Poor',
            '0.06' => 'Moderate',
            '0.1'  => 'Good',
            '0.2'  => 'Excellent'
        ],
        'raw_materials' => [
            '0.6'  => 'Very Poor',
            '0.55' => 'Poor',
            '0.45' => 'Moderate',
            '0.35' => 'Good',
            '0.3'  => 'Excellent'
        ],
    ],
];

