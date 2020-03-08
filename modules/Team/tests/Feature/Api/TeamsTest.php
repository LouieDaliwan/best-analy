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
    public function a_user_can_only_retrieve_their_owned_paginated_list_of_teams()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.index']), ['teams.index']);
        $this->withPermissionsPolicy();

        $teams = factory(Team::class, 5)->create(['user_id' => $user->getKey()]);

        // Actions
        $response = $this->get(route('api.teams.index'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => [['user_id' => $user->getKey()]]])
            ->assertJsonStructure([
                'data' => [[
                    'name', 'code', 'description', 'icon',
                    'lead', 'members', 'author', 'created', 'modified',
                ]],
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
        $this->withoutExceptionHandling();
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.store']), ['teams.store']);
        $this->withPermissionsPolicy();

        // Actions
        $team = factory(Team::class)->make(['user_id' => $user->getKey()])->toArray();
        $attributes = array_merge($team, [
            'users' => factory(User::class, 3)->create()->pluck('id')->toArray(),
        ]);
        $response = $this->post(route('api.teams.store'), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($this->service->getTable(), $team);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_only_retrieve_an_owned_single_team()
    {
        // Arrangements
        $this->withoutExceptionHandling();
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.show']), ['teams.show']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->get(route('api.teams.show', $team->getKey()));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => ['user_id' => $user->getKey()]])
            ->assertJsonStructure([
                'data' => [
                    'name', 'code', 'description', 'icon',
                    'lead', 'members', 'author', 'created', 'modified',
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
    public function a_user_can_only_update_an_owned_team()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.update']), ['teams.update']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $attributes = array_merge($team->toArray(), [
            'users' => factory(User::class, 3)->create()->pluck('id')->toArray(),
        ]);
        $response = $this->put(route('api.teams.update', $team->getKey()), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($team->getTable(), $team->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_only_soft_delete_an_owned_team()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.destroy']), ['teams.destroy']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->delete(route('api.teams.destroy', $team->getKey()));
        $team = $this->service->withTrashed()->find($team->getKey());

        // Assertions
        $response->assertSuccessful();
        $this->assertSoftDeleted($team->getTable(), $team->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_only_soft_delete_multiple_owned_teams()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.destroy']), ['teams.destroy']);
        $this->withPermissionsPolicy();
        $teams = factory(Team::class, 3)->create(['user_id' => $user->getKey()]);

        // Actions
        $attributes = ['id' => $teams->pluck('id')->toArray()];
        $response = $this->delete(route('api.teams.destroy', 'null'), $attributes);
        $teams = $this->service->onlyTrashed();

        // Assertions
        $response->assertSuccessful();
        $teams->each(function ($team) {
            $this->assertSoftDeleted($team->getTable(), $team->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_only_retrieve_their_owned_paginated_list_of_trashed_teams()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.trashed']), ['teams.trashed']);
        $this->withPermissionsPolicy();
        $teams = factory(Team::class, 2)->create(['user_id' => $user->getKey()]);
        $teams->each->delete();

        // Actions
        $response = $this->get(route('api.teams.trashed'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => [['user_id' => $user->getKey()]]])
            ->assertJsonStructure([
                'data' => [[
                    'name', 'code', 'description', 'icon',
                    'lead', 'members', 'author', 'created', 'modified',
                ]],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_only_restore_owned_destroyed_teams()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.restore']), ['teams.restore']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 3)->create(['user_id' => $user->getKey()])->random();
        $team->delete();

        // Actions
        $response = $this->patch(route('api.teams.restore', $team->getKey()));
        $team = $this->service->find($team->getKey());

        // Assertions
        $response->assertSuccessful();
        $this->assertFalse($team->trashed());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_only_restore_multiple_owned_destroyed_teams()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.restore']), ['teams.restore']);
        $this->withPermissionsPolicy();
        $teams = factory(Team::class, 3)->create(['user_id' => $user->getKey()]);
        $teams->each->delete();

        // Actions
        $attributes = ['id' => $teams->pluck('id')->toArray()];
        $response = $this->patch(route('api.teams.restore'), $attributes);
        $teams = $this->service->whereIn('id', $attributes['id'])->get();

        // Assertions
        $response->assertSuccessful();
        $teams->each(function ($team) {
            $this->assertFalse($team->trashed());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:team
     * @return void
     */
    public function a_user_can_only_permanently_delete_an_owned_team()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.delete']), ['teams.delete']);
        $this->withPermissionsPolicy();
        $team = factory(Team::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->delete(route('api.teams.delete', $team->getKey()));

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
    public function a_user_can_only_permanently_delete_multiple_owned_teams()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['teams.delete']), ['teams.delete']);
        $this->withPermissionsPolicy();
        $teams = factory(Team::class, 3)->create(['user_id' => $user->getKey()]);

        // Actions
        $attributes = ['id' => $teams->pluck('id')->toArray()];
        $response = $this->delete(route('api.teams.delete'), $attributes);

        // Assertions
        $response->assertSuccessful();
        $teams->each(function ($team) {
            $this->assertDatabaseMissing($team->getTable(), $team->toArray());
        });
    }
}
