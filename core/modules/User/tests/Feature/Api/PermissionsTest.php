<?php

namespace User\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;
use User\Services\PermissionServiceInterface;

/**
 * @package User\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PermissionsTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(PermissionServiceInterface::class);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:permission
     * @return void
     */
    public function a_user_can_retrieve_the_list_of_permissions_grouped_by_modules()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['permissions.index']), ['permissions.index']);
        $this->withPermissionsPolicy();

        // Actions
        $response = $this->get(route('api.permissions.index'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJsonStructure([
                '*' => [[
                    'name',
                    'code',
                    'description',
                    'group',
                ]],
            ]);
    }
}
