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

        // Actions
        $this->service->store($attributes);

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

        // Actions
        $attributes = [
            'name' => $this->faker->unique()->words($nb = 10, $asText = true),
            'icon' => $this->faker->words($nb = 3, $asText = true)
        ];
        $actual = $this->service->update($team->getKey(), $attributes);

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
    public function it_can_destroy_a_team()
    {
        // Arrangements
        $team = factory(Team::class, 3)->create()->random();

        // Actions
        $this->service->destroy($team->getKey());

        // Assertions
        $this->assertDatabaseMissing($this->service->getTable(), $team->toArray());
    }

    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  unit:service:team
     * @return void
     */
    public function it_can_destroy_multiple_teams()
    {
        // Arrangements
        $teams = factory(Team::class, 3)->create();

        // Actions
        $this->service->destroy($teams->pluck('id')->toArray());

        // Assertions
        $teams->each(function ($team) {
            $this->assertDatabaseMissing($this->service->getTable(), $team->toArray());
        });
    }
}
