<?php

namespace User\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\ActingAsUser;
use Tests\TestCase;
use User\Models\User;

/**
 * @package User\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class UsersTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser;

    /**
     * @test
     * @group  feature
     * @group  api:user
     * @return void
     */
    public function a_user_can_retrieve_a_paginated_list_of_users()
    {
        // Arrangements
        $users = factory(User::class, 20)->create();

        // Actions
        $response = $this->json('GET', 'api/v1/users');

        // Assertions
        $response->assertSuccessful();
    }
}
