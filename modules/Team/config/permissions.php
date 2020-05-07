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
     * Team Permissions
     *--------------------------------------------------------------------------
     *
     */
    'index-teams' => [
        'name' =>  'index-teams',
        'code' => 'teams.index',
        'description' => 'Ability to view list of teams',
        'group' => 'team',
    ],
    'show-team' => [
        'name' => 'show-team',
        'code' => 'teams.show',
        'description' => 'Ability to show a single team',
        'group' => 'team',
    ],
    'create-team' => [
        'name' => 'create-team',
        'code' => 'teams.create',
        'description' => 'Ability to create new team',
        'group' => 'team',
    ],
    'store-team' => [
        'name' => 'store-team',
        'code' => 'teams.store',
        'description' => 'Ability to save the team',
        'group' => 'team',
    ],
    'edit-team' => [
        'name' => 'edit-team',
        'code' => 'teams.edit',
        'description' => 'Ability to view the edit form',
        'group' => 'team',
    ],
    'update-team' => [
        'name' => 'update-team',
        'code' => 'teams.update',
        'description' => 'Ability to update the team',
        'group' => 'team',
    ],
    'destroy-team' => [
        'name' => 'destroy-team',
        'code' =>  'teams.destroy',
        'description' => 'Ability to move the team to trash',
        'group' => 'team',
    ],
    'delete-team' => [
        'name' => 'delete-team',
        'code' =>  'teams.delete',
        'description' => 'Ability to permanently delete the team',
        'group' => 'team',
    ],
    'trashed-teams' => [
        'name' => 'trashed-teams',
        'code' =>  'teams.trashed',
        'description' => 'Ability to view the list of all trashed teams',
        'group' => 'team',
    ],
    'restore-team' => [
        'name' => 'restore-team',
        'code' => 'teams.restore',
        'description' => 'Ability to restore the team from trash',
        'group' => 'team',
    ],
    'dashboard-team' => [
        'name' => 'dashboard-team',
        'code' => 'teams.dashboard',
        'description' => 'Ability to view all teams from the dashboard',
        'group' => 'team',
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
    'unrestricted-team-access' => [
        'name' => 'unrestricted-team-access',
        'code' => 'teams.unrestricted',
        'description' => 'Ability to edit and delete all teams even if the user is not the creator of the team.',
        'group' => 'team',
    ],

    'owned-teams' => [
        'name' => 'owned-teams',
        'code' => 'teams.owned',
        'description' => 'Ability to manage only owned team.',
        'group' => 'team',
    ],

    'members-teams' => [
        'name' => 'members-teams',
        'code' => 'teams.members',
        'description' => 'Ability to view list of their team members.',
        'group' => 'team',
    ],

    'export-teams' => [
        'name' => 'export-teams',
        'code' => 'teams.export',
        'description' => 'Ability to export team data.',
        'group' => 'team',
    ],
];
