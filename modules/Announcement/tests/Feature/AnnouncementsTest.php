<?php

namespace Tests\Announcement\Feature;

use Announcement\Models\Announcement;
use Announcement\Services\AnnouncementServiceInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

/**
 * @package Announcement\Feature
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class AnnouncementsTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    /**
     * @test
     * @group  feature
     * @group  feature:announcements
     * @return void
     */
    public function it_can_list_a_paginated_resources_of_all_available_announcements()
    {
        // Arrangements
        $expected = factory(Announcement::class, 10)->create();
        $service = $this->app->make(AnnouncementServiceInterface::class);

        // Actions
        // dd();
        $actual = $service->list();


        // Assertions
        $this->assertInstanceOf(LengthAwarePaginator::class, $actual);
    }
}
