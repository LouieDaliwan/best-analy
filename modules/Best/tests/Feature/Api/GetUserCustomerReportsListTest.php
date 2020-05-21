<?php

namespace Best\Feature\Api;

use Best\Models\Report;
use Best\Services\ReportServiceInterface;
use Customer\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;
use User\Models\User;

/**
 * @package Best\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class GetUserCustomerReportsListTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(ReportServiceInterface::class);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:reports
     * @return void
     */
    public function a_user_can_retrieve_the_list_of_reports_of_a_user_per_customer()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['reports.user']), ['reports.user']);
        $this->withPermissionsPolicy();

        $user = factory(User::class)->create();
        $customer = factory(Customer::class, 2)->create(['user_id' => $user->getKey()])->random();
        $reports = factory(Report::class, 2)->create([
            'month' => date('m-Y'),
            'user_id' => $user->getKey(),
            'customer_id' => $customer->getKey(),
        ]);

        // Actions
        $response = $this->get(route('api.reports.user', [$user->getKey(), $customer->getKey()]));

        // Assertions
        $response->assertSuccessful();
    }
}
