<?php

namespace Customer\Tests\Integration\Api;

use Customer\Support\Crm\Contracts\CrmInterface;
use Customer\Support\Crm\FileNumber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * Note:
 *
 * This test is only meant to run on a specific
 * network as resources used in this feature is only
 * available behind a certain private network.
 *
 * Therefore, this test is under a different folder
 * to prevent it from running on the
 * main continuous integration tool.
 *
 * To test this file run:
 *
 * ./vendor/bin/phpunit --configuration modules/Customer/tests/phpunit.integration.xml \
 * ./modules/Customer/tests/Integration/CrmTest.php
 *
 * Make sure your network is configured appropriately
 * to access the API endpoints used in this test.
 *
 * @package Customer\Tests\Integration\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class CrmTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->crm = $this->app->make(CrmInterface::class);
        $this->superAdmin = $this->asSuperAdmin();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:crm
     * @group  feature:crm:api
     * @return void
     */
    public function a_user_can_search_for_customer_from_crm_upon_supplying_a_filenumber()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['crm.search']), ['crm.search']);
        $this->withPermissionsPolicy();

        $fileNumber = new FileNumber($this->faker->randomNumber(5));

        // Actions
        $response = $this->get(route('api.crm.search', (string) $fileNumber));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJsonStructure(['Code', 'Message', 'Content']);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:crm
     * @group  feature:crm:api
     * @return void
     */
    public function a_user_can_update_customer_data_to_crm()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['crm.save']), ['crm.save']);
        $this->withPermissionsPolicy();

        $fileNumber = new FileNumber($this->faker->randomNumber(5));

        // Actions
        $attributes = [
            'OverallScore' => '20.0',
            'FileNo' => (string) $fileNumber,
            'Id' => $this->faker->uuid(),
            'FileContentBase64' => base64_encode('test-data'),
            'Comments' => $this->faker->sentence(),
        ];
        $response = $this->post(route('api.crm.save'), $attributes);

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJsonStructure(['Code', 'Message', 'Content']);
    }
}
