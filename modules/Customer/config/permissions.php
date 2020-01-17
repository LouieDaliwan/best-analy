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
     * Customer Permissions
     *--------------------------------------------------------------------------
     *
     */
    'index-customers' => [
        'name' =>  'index-customers',
        'code' => 'customers.index',
        'description' => 'Ability to view list of customers',
        'group' => 'customer',
    ],
    'show-customer' => [
        'name' => 'show-customer',
        'code' => 'customers.show',
        'description' => 'Ability to show a single customer',
        'group' => 'customer',
    ],
    'create-customer' => [
        'name' => 'create-customer',
        'code' => 'customers.create',
        'description' => 'Ability to create new customer',
        'group' => 'customer',
    ],
    'store-customer' => [
        'name' => 'store-customer',
        'code' => 'customers.store',
        'description' => 'Ability to save the customer',
        'group' => 'customer',
    ],
    'edit-customer' => [
        'name' => 'edit-customer',
        'code' => 'customers.edit',
        'description' => 'Ability to view the edit form',
        'group' => 'customer',
    ],
    'update-customer' => [
        'name' => 'update-customer',
        'code' => 'customers.update',
        'description' => 'Ability to update the customer',
        'group' => 'customer',
    ],
    'destroy-customer' => [
        'name' => 'destroy-customer',
        'code' =>  'customers.destroy',
        'description' => 'Ability to move the customer to trash',
        'group' => 'customer',
    ],
    'delete-customer' => [
        'name' => 'delete-customer',
        'code' =>  'customers.delete',
        'description' => 'Ability to permanently delete the customer',
        'group' => 'customer',
    ],
    'trashed-customers' => [
        'name' => 'trashed-customers',
        'code' =>  'customers.trashed',
        'description' => 'Ability to view the list of all trashed customers',
        'group' => 'customer',
    ],
    'restore-customer' => [
        'name' => 'restore-customer',
        'code' => 'customers.restore',
        'description' => 'Ability to restore the customer from trash',
        'group' => 'customer',
    ],

    /**
     *--------------------------------------------------------------------------
     * Limited Access Policies
     *--------------------------------------------------------------------------
     * The policy stated below will limit the users to only interact with
     * resources they created. Using this policy, the resource will usually have
     * a `user_id` field defined. A Policy Class is also required to check
     * authorization.
     *
     * E.g.
     *  1. User1 will only be able to edit/delete their own created pages.
     *  2. User1 will not be able to edit User2's created pages.
     *  3. User1 will not be able to delete User2's created pages.
     *  4. User1 will be able to view other users created pages. Although this can
     *     be set to be otherwise. It will depend on the Policy file.
     */
    'unrestricted-customer-access' => [
        'name' => 'unrestricted-customer-access',
        'code' => 'customers.unrestricted',
        'description' => 'Ability to edit and delete all customers even if the user is not the creator of the customer.',
        'group' => 'customer',
    ],

    'owned-customers' => [
        'name' => 'owned-customers',
        'code' => 'customers.owned',
        'description' => 'Ability to manage only owned customer.',
        'group' => 'customer',
    ],

    /**
     * -------------------------------------------------------------------------
     * Crm Permissions
     * -------------------------------------------------------------------------
     *
     */
    'search-crm' => [
        'name' => 'search-crm',
        'code' => 'crm.search',
        'description' => 'Ability to search customers from the 3rd Party CRM',
        'group' => 'crm',
    ],

    'save-crm' => [
        'name' => 'save-crm',
        'code' => 'crm.save',
        'description' => 'Ability to save customer data from the 3rd Party CRM',
        'group' => 'crm',
    ],
];
