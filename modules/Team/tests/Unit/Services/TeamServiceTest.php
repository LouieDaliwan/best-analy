<?php

namespace Team\Unit\Services;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Team\Models\Team;
use Team\Services\TeamServiceInterface;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;
use User\Models\User;

/**
 * @package Team\Unit\Services
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class TeamServiceTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(TeamServiceInterface::class);
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_retrieve_the_paginated_list_of_all_teams()
    {
        // Arrangements
        $teams = factory(Team::class, 10)->create();

        // Actions
        $actual = $this->service->list();

        // Assertions
        $this->assertInstanceOf(LengthAwarePaginator::class, $actual);
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_store_a_team_to_database()
    {
        // Arrangements
        $attributes = factory(Team::class)->make()->toArray();
        $members = factory(User::class, 3)->create()->pluck('id')->toArray();

        // Actions
        $this->service->store(array_merge($attributes, ['users' => $members]));

        // Assertions
        $this->assertDatabaseHas($this->service->getTable(), $attributes);
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_retrieve_a_single_team()
    {
        // Arrangements
        $expected = factory(Team::class, 5)->create();

        // Actions
        $actual = $this->service->find($expected->random()->getKey());

        // Assertions
        $this->assertInstanceOf(Team::class, $actual);
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_update_a_team()
    {
        // Arrangements
        $team = factory(Team::class)->create();
        $members = factory(User::class, 3)->create()->pluck('id')->toArray();

        // Actions
        $attributes = factory(Team::class)->make([
            'name' => $this->faker->unique()->words($nb = 10, $asText = true),
            'icon' => $this->faker->words($nb = 3, $asText = true)
        ])->toArray();
        $actual = $this->service->update($team->getKey(), array_merge(
            $attributes, ['users' => $members]
        ));

        // Assertions
        $this->assertDatabaseHas($this->service->getTable(), $attributes);
        $this->assertTrue($actual);
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_soft_delete_a_team()
    {
        // Arrangements
        $team = factory(Team::class, 3)->create()->random();

        // Actions
        $this->service->destroy($team->getKey());

        // Assertions
        $this->assertSoftDeleted($this->service->getTable(), $team->toArray());
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_soft_delete_multiple_teams()
    {
        // Arrangements
        $teams = factory(Team::class, 3)->create();

        // Actions
        $this->service->destroy($teams->pluck('id')->toArray());

        // Assertions
        $teams->each(function ($team) {
            $this->assertSoftDeleted($this->service->getTable(), $team->toArray());
        });
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_retrieve_the_paginated_list_of_all_trashed_team()
    {
        // Arrangements
        $teams = factory(Team::class, 2)->create();
        $trashed = factory(Team::class, 2)->create();
        $trashed->each->delete();

        // Actions
        $actual = $this->service->listTrashed();

        // Assertions
        $this->assertInstanceOf(LengthAwarePaginator::class, $actual);
        $teams->each(function ($team) use ($actual) {
            $this->assertFalse($team->trashed());
            $this->assertFalse($actual->contains($team->getKeyName(), $team->getKey()));
        });
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_restore_destroyed_team()
    {
        // Arrangements
        $team = factory(Team::class, 3)->create()->random();
        $team->delete();

        // Actions
        $this->service->restore($team->getKey());
        $actual = $this->service->withTrashed()->find($team->getKey());

        // Assertions
        $this->assertFalse($actual->trashed());
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_restore_multiple_destroyed_teams()
    {
        // Arrangements
        $teams = factory(Team::class, 3)->create();
        $teams->each->delete();

        // Actions
        $this->service->restore($ids = $teams->pluck('id')->toArray());
        $actual = $this->service->withTrashed()->whereIn('id', $ids)->get();

        // Assertions
        $actual->each(function ($team) {
            $this->assertFalse($team->trashed());
        });
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_permanently_delete_a_team()
    {
        // Arrangements
        $team = factory(Team::class, 3)->create()->random();

        // Actions
        $this->service->delete($team->getKey());

        // Assertions
        $this->assertDatabaseMissing($team->getTable(), $team->toArray());
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_permanently_delete_multiple_teams()
    {
        // Arrangements
        $teams = factory(Team::class, 3)->create();

        // Actions
        $this->service->delete($teams->pluck('id')->toArray());

        // Assertions
        $teams->each(function ($team) {
            $this->assertDatabaseMissing($team->getTable(), $team->toArray());
        });
    }
}
