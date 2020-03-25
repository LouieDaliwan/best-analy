<?php

use Best\Pro\TrafficLight;

return [
    'grades' => [
        'nonlight' => 0.29,
        TrafficLight::RED_LIGHT => 0.49,
        TrafficLight::AMBER_LIGHT => 0.89,
        TrafficLight::GREEN_LIGHT => 0,
    ],

    'key_enablers_score' => [
        'fmpi' => [
            'Documentation' => 5,
            'Talent' => 5,
            'Technology' => 5,
            'Workflow Processes' => 5,
        ],
        'hrpi' => [
            'Documentation' => 5,
            'Talent' => 5,
            'Technology' => 5,
            'Workflow Processes' => 5,
        ],
        'pmpi' => [
            'Documentation' => 5,
            'Talent' => 5,
            'Technology' => 5,
            'Workflow Processes' => 5,
        ],
        'bspi' => [
            'Documentation' => 5,
            'Talent' => 5,
            'Technology' => 5,
            'Workflow Processes' => 5,
        ],
    ],

    'has_greaterThan90_value' => [
        'hrpi' => true,
        'bspi' => false,
        'pmpi' => false,
        'fmpi' => false,
    ],
];