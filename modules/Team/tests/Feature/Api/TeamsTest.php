<?php

namespace Team\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Team\Models\Team;
use Team\Services\TeamServiceInterface;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Team\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class TeamsTest extends TestCase
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
    public function a_user_can_retrieve_the_paginated_list_of_all_teams()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.index']), ['teams.index']);
        $this->withPermissionsPolicy();

        $teams = factory(Team::class, 5)->create(['user_id' => $user->getKey()]);

        // Actions
        $response = $this->get(route('api.teams.index'));

        // Assertions
        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data' => [[
                'name',
                'code',
                'description',
                'icon',
                'lead',
                'members',
                'created',
                'modified',
            ]]
        ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_store_a_team_to_database()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.store']), ['teams.store']);
        $this->withPermissionsPolicy();

        // Actions
        $attributes = factory(Team::class)->make(['user_id' => $user->getKey()])->toArray();
        $response = $this->post(route('api.teams.store'), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($this->service->getTable(), $attributes);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_retrieve_a_single_team()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.show']), ['teams.show']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->get(route('api.teams.show', $team->getKey()));

        // Assertions
        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data' => [
                'name',
                'code',
                'description',
                'icon',
                'lead',
                'members',
                'created',
                'modified',
            ],
        ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_update_a_team()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.update']), ['teams.update']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $attributes = factory(Team::class)->make(['user_id' => $user->getKey()])->toArray();
        $response = $this->put(route('api.teams.update', $team->getKey()), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($team->getTable(), $attributes);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_destroy_a_team()
    {
        // Arrangements
        $this->withoutExceptionHandling();
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.destroy']), ['teams.destroy']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->delete(route('api.teams.destroy', $team->getKey()));

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseMissing($team->getTable(), $team->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_destroy_multiple_teams()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.destroy']), ['teams.destroy']);
        $this->withPermissionsPolicy();
        $teams = factory(Team::class, 3)->create(['user_id' => $user->getKey()]);

        // Actions
        $attributes = ['id' => $teams->pluck('id')->toArray()];
        $response = $this->delete(route('api.teams.destroy', 'null'), $attributes);

        // Assertions
        $response->assertSuccessful();
        $teams->each(function ($index) {
            $this->assertDatabaseMissing($index->getTable(), $index->toArray());
        });
    }
}
