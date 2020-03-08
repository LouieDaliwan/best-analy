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

/**
 * @package Team\Tests\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class TeamsOwnedByOthersTest extends TestCase
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
    public function a_user_cannot_retrieve_the_paginated_list_of_teams_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.index']), ['teams.index']);
        $this->withPermissionsPolicy();

        $owned = factory(Team::class, 5)->create(['user_id' => $user->getKey()]);
        $teams = factory(Team::class, 5)->create();

        // Actions
        $response = $this->get(route('api.teams.index'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => $owned->toArray()])
            ->assertDontSee($teams->random()->code)
            ->assertJsonMissing($teams->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_cannot_retrieve_a_single_team_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.show']), ['teams.show']);
        $this->withPermissionsPolicy();

        $owned = factory(Team::class, 5)->create(
            ['user_id' => $user->getKey()
        ])->random();
        $team = factory(Team::class, 5)->create()->random();

        // Actions
        $response = $this->get(route('api.teams.show', $team->getKey()));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_cannot_update_a_team_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.update']), ['teams.update']);
        $this->withPermissionsPolicy();

        $owned = factory(Team::class, 5)->create([
            'user_id' => $user->getKey()
        ])->random();
        $team = factory(Team::class, 5)->create()->random();

        // Actions
        $attributes = factory(Team::class)->make(['user_id' => $user->getKey()])->toArray();
        $response = $this->put(route('api.teams.update', $team->getKey()), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_cannot_soft_delete_a_team_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.destroy']), ['teams.destroy']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 3)->create()->random();

        // Actions
        $response = $this->delete(route('api.teams.destroy', $team->getKey()));
        $team = $this->service->withTrashed()->find($team->getKey());

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_cannot_soft_delete_multiple_teams_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.destroy']), ['teams.destroy']);
        $this->withPermissionsPolicy();
        $teams = factory(Team::class, 3)->create();

        // Actions
        $attributes = ['id' => $teams->pluck('id')->toArray()];
        $response = $this->delete(route('api.teams.destroy', 'null'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_cannot_retrieve_the_paginated_list_of_trashed_teams_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.trashed']), ['teams.trashed']);
        $this->withPermissionsPolicy();

        $owned = factory(Team::class, 5)->create(['user_id' => $user->getKey()]);
        $owned->each->delete();
        $teams = factory(Team::class, 5)->create();
        $teams->each->delete();

        // Actions
        $response = $this->get(route('api.teams.trashed'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => $owned->toArray()])
            ->assertDontSee($teams->random()->code)
            ->assertJsonMissing($teams->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_cannot_restore_destroyed_teams_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.restore']), ['teams.restore']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 3)->create()->random();
        $team->delete();

        // Actions
        $response = $this->patch(route('api.teams.restore', $team->getKey()));
        $team = $this->service->withTrashed()->find($team->getKey());

        // Assertions
        $response->assertForbidden();
        $this->assertTrue($team->trashed());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_cannot_restore_multiple_destroyed_teams_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.restore']), ['teams.restore']);
        $this->withPermissionsPolicy();
        $teams = factory(Team::class, 3)->create();
        $teams->each->delete();

        // Actions
        $attributes = ['id' => $teams->pluck('id')->toArray()];
        $response = $this->patch(route('api.teams.restore'), $attributes);
        $teams = $this->service->withTrashed()->whereIn('id', $attributes['id'])->get();

        // Assertions
        $response->assertForbidden();
        $teams->each(function ($team) {
            $this->assertTrue($team->trashed());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_cannot_permanently_delete_a_team_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.delete']), ['teams.delete']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 2)->create()->random();

        // Actions
        $response = $this->delete(route('api.teams.delete', $team->getKey()));

        // Assertions
        $response->assertForbidden();
        $this->assertDatabaseHas($team->getTable(), $team->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_cannot_permanently_delete_multiple_teams_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.delete']), ['teams.delete']);
        $this->withPermissionsPolicy();
        $teams = factory(Team::class, 3)->create();

        // Actions
        $attributes = ['id' => $teams->pluck('id')->toArray()];
        $response = $this->delete(route('api.teams.delete'), $attributes);

        // Assertions
        $response->assertForbidden();
        $teams->each(function ($team) {
            $this->assertDatabaseHas($team->getTable(), $team->toArray());
        });
    }
}
