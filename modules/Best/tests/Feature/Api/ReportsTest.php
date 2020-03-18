<?php

namespace Best\Feature\Api;

use Best\Models\Report;
use Best\Services\ReportServiceInterface;
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
class ReportsTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

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
    public function a_user_can_retrieve_the_list_of_all_reports()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['reports.index']), ['reports.index']);
        $this->withPermissionsPolicy();

        $report = factory(Report::class, 5)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->get(route('api.reports.index'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => [['user_id' => $user->getKey()]]])
            ->assertJsonStructure([
                'data' => [[
                    'customer',
                    'created',
                    'deleted',
                    'modified',
                ]],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:reports
     * @return void
     */
    public function a_user_can_retrieve_a_single_report()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['reports.single']), ['reports.single']);
        $this->withPermissionsPolicy();

        $report = factory(Report::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->get(route('api.reports.single', $report->getKey()));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => ['user_id' => $user->getKey()]])
            ->assertJsonStructure([
                'data' => [
                    'customer',
                    'created',
                    'deleted',
                    'modified',
                ],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:reports
     * @return void
     */
    public function a_user_can_delete_a_report()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['reports.delete']), ['reports.delete']);
        $this->withPermissionsPolicy();

        $report = factory(Report::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->delete(route('api.reports.delete', $report->getKey()));

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseMissing($report->getTable(), $report->toArray());
    }
}
