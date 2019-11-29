<?php

namespace User\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
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
        Passport::actingAs($this->asSuperAdmin());
        $users = factory(User::class, 10)->create();

        // Actions
        $response = $this->json('GET', route('api.v1.users.index'));

        // Assertions
        $response->assertSuccessful()
                 ->assertJsonFragment([
                    'firstname' => $users->random()->firstname,
                    'lastname' => $users->random()->lastname,
                    'email' => $users->random()->email,
                    'type' => $users->random()->type,
                ]);
    }
}
