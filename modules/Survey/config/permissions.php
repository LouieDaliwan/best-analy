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
     * Survey Permissions
     *--------------------------------------------------------------------------
     *
     */
    'index-surveys' => [
        'name' =>  'index-surveys',
        'code' => 'surveys.index',
        'description' => 'Ability to view list of surveys',
        'group' => 'survey',
    ],
    'show-survey' => [
        'name' => 'show-survey',
        'code' => 'surveys.show',
        'description' => 'Ability to show a single survey',
        'group' => 'survey',
    ],
    'create-survey' => [
        'name' => 'create-survey',
        'code' => 'surveys.create',
        'description' => 'Ability to create new survey',
        'group' => 'survey',
    ],
    'store-survey' => [
        'name' => 'store-survey',
        'code' => 'surveys.store',
        'description' => 'Ability to save the survey',
        'group' => 'survey',
    ],
    'edit-survey' => [
        'name' => 'edit-survey',
        'code' => 'surveys.edit',
        'description' => 'Ability to view the edit form',
        'group' => 'survey',
    ],
    'update-survey' => [
        'name' => 'update-survey',
        'code' => 'surveys.update',
        'description' => 'Ability to update the survey',
        'group' => 'survey',
    ],
    'destroy-survey' => [
        'name' => 'destroy-survey',
        'code' =>  'surveys.destroy',
        'description' => 'Ability to move the survey to trash',
        'group' => 'survey',
    ],
    'delete-survey' => [
        'name' => 'delete-survey',
        'code' =>  'surveys.delete',
        'description' => 'Ability to permanently delete the survey',
        'group' => 'survey',
    ],
    'trashed-surveys' => [
        'name' => 'trashed-surveys',
        'code' =>  'surveys.trashed',
        'description' => 'Ability to view the list of all trashed surveys',
        'group' => 'survey',
    ],
    'restore-survey' => [
        'name' => 'restore-survey',
        'code' => 'surveys.restore',
        'description' => 'Ability to restore the survey from trash',
        'group' => 'survey',
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
    'unrestricted-survey-access' => [
        'name' => 'unrestricted-survey-access',
        'code' => 'surveys.unrestricted',
        'description' => 'Ability to edit and delete all surveys even if the user is not the creator of the survey.',
        'group' => 'survey',
    ],

    'owned-surveys' => [
        'name' => 'owned-surveys',
        'code' => 'surveys.owned',
        'description' => 'Ability to manage only owned survey.',
        'group' => 'survey',
    ],

    'submit-surveys' => [
        'name' => 'submit-surveys',
        'code' => 'surveys.submit',
        'description' => 'Ability to manage only submit survey.',
        'group' => 'survey',
    ],
];
