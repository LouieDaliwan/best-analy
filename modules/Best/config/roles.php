<?php

return [
    [
        'name' => 'Manager',
        'code' => 'manager',
        'alias' => 'Manager (Sector)',
        'description' => 'Monitors performance',
        'permissions' => [
            'crm.save',
            'crm.search',
            'customers.create',
            'customers.delete',
            'customers.destroy',
            'customers.edit',
            'customers.generate',
            'customers.owned',
            'customers.restore',
            'customers.show',
            'customers.store',
            'customers.trashed',
            'customers.update',
            'surveys.generate',
            'surveys.report',
            'surveys.show',
            'surveys.submit',
            'settings.general',
            'settings.store',
        ],
    ],
    [
        'name' => 'Advisor',
        'code' => 'advisor',
        'alias' => 'Advisor',
        'description' => 'Manage customer Performance Index, generate reports that sends to the CRM app',
        'permissions' => [
            'crm.save',
            'crm.search',
            'customers.create',
            'customers.delete',
            'customers.destroy',
            'customers.edit',
            'customers.generate',
            'customers.owned',
            'customers.restore',
            'customers.show',
            'customers.store',
            'customers.trashed',
            'customers.update',
            'surveys.generate',
            'surveys.report',
            'surveys.show',
            'surveys.submit',
            'settings.general',
            'settings.store',
        ],
    ],
];
