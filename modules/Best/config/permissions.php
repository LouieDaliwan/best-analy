<?php
/**
 *------------------------------------------------------------------------------
 * Permissions Array
 *------------------------------------------------------------------------------
 *
 * Here we define our permissions that you can attach to roles.
 *
 * These permissions corresponds to a counterpart
 * route (found in <this module>/routes/<route-files>.php).
 * All permissionable routes should have a `name` (e.g. 'roles.store')
 * for the role authentication middleware to work.
 *
 */
return [
    /**
     *--------------------------------------------------------------------------
     * Best Permissions
     *--------------------------------------------------------------------------
     *
     */
    'formulas-best' => [
        'name' =>  'formulas-best',
        'code' => 'best.formulas',
        'description' => 'Ability to view list of BEST formulas',
        'group' => 'best',
    ],
    'delete-report' => [
        'name' => 'delete-report',
        'code' =>  'reports.delete',
        'description' => 'Ability to delete the report permanently',
        'group' => 'best',
    ],
    'faq-admin' => [
        'name' => 'faq-admin',
        'code' =>  'faqs.admin',
        'description' => 'Ability to view instructional videos of the app for admin role',
        'group' => 'best',
    ],
    'faq-manager' => [
        'name' => 'faq-manager',
        'code' =>  'faqs.manager',
        'description' => 'Ability to view instructional videos of the app for manager role',
        'group' => 'best',
    ],
    'faq-counselor' => [
        'name' => 'faq-counselor',
        'code' =>  'faqs.counselor',
        'description' => 'Ability to view instructional videos of the app for business counselor role',
        'group' => 'best',
    ],
];
