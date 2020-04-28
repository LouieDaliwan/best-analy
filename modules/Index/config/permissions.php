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
     * Index Permissions
     *--------------------------------------------------------------------------
     *
     */
    'index-indices' => [
        'name' =>  'index-indices',
        'code' => 'indices.index',
        'description' => 'Ability to view list of indices',
        'group' => 'index',
    ],
    'show-index' => [
        'name' => 'show-index',
        'code' => 'indices.show',
        'description' => 'Ability to show a single index',
        'group' => 'index',
    ],
    'create-index' => [
        'name' => 'create-index',
        'code' => 'indices.create',
        'description' => 'Ability to create new index',
        'group' => 'index',
    ],
    'store-index' => [
        'name' => 'store-index',
        'code' => 'indices.store',
        'description' => 'Ability to save the index',
        'group' => 'index',
    ],
    'edit-index' => [
        'name' => 'edit-index',
        'code' => 'indices.edit',
        'description' => 'Ability to view the edit form',
        'group' => 'index',
    ],
    'update-index' => [
        'name' => 'update-index',
        'code' => 'indices.update',
        'description' => 'Ability to update the index',
        'group' => 'index',
    ],
    'destroy-index' => [
        'name' => 'destroy-index',
        'code' =>  'indices.destroy',
        'description' => 'Ability to move the index to trash',
        'group' => 'index',
    ],
    'delete-index' => [
        'name' => 'delete-index',
        'code' =>  'indices.delete',
        'description' => 'Ability to permanently delete the index',
        'group' => 'index',
    ],
    'trashed-indices' => [
        'name' => 'trashed-indices',
        'code' =>  'indices.trashed',
        'description' => 'Ability to view the list of all trashed indices',
        'group' => 'index',
    ],
    'restore-index' => [
        'name' => 'restore-index',
        'code' => 'indices.restore',
        'description' => 'Ability to restore the index from trash',
        'group' => 'index',
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
    'unrestricted-index-access' => [
        'name' => 'unrestricted-index-access',
        'code' => 'indices.unrestricted',
        'description' => 'Ability to edit and delete all indices even if the user is not the creator of the index.',
        'group' => 'index',
    ],

    'owned-indices' => [
        'name' => 'owned-indices',
        'code' => 'indices.owned',
        'description' => 'Ability to manage only owned index.',
        'group' => 'index',
    ],

    'settings-indices' => [
        'name' => 'settings-indices',
        'code' => 'indices.settings',
        'description' => 'Ability to view indices settings.',
        'group' => 'index',
    ],
];
