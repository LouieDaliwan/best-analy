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
];
