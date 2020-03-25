<?php

namespace Team\Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Team\Models\Team;
use Team\Services\TeamServiceInterface;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;
use User\Models\User;

/**
 * @package Team\Tests\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class TeamsOwnedTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(TeamServiceInterface::class);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_only_retrieve_their_owned_paginated_list_of_teams()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.owned']), ['teams.owned']);
        $this->withPermissionsPolicy();

        $team = factory(Team::class)->create(['manager_id' => $user->getKey()]);
        $team->members()->attach(factory(User::class)->create());
        $team->members()->attach(factory(User::class)->create());
        $team->members()->attach(factory(User::class)->create());

        // Actions
        $response = $this->get(route('api.teams.owned'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [[
                    'members', 'lead', 'created', 'modified',
                ]],
            ]);
    }
}