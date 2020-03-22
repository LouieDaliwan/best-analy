<?php

namespace Survey\Unit\Services;

use Best\Models\Report;
use Best\Services\ReportServiceInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Survey\Unit\Services
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ReportServiceTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /**
     * @test
     * @group  unit
     * @group  unit:survey
     * @group  unit:survey:service
     * @group  unit:survey:service:report
     * @return void
     */
    public function a_user_can_store_a_report_to_database()
    {
        // Arrangements
        $service = app(ReportServiceInterface::class);
        $attributes = factory(Report::class)->make()->toArray();

        // Actions
        $attributes = array_merge($attributes, [
            'value' => $this->faker->randomDigitNotNull(),
        ]);
        $actual = $service->store($attributes);

        // Assertions
        $this->assertDatabaseHas($service->getTable(), $attributes);
    }

    /**
     * @test
     * @group  unit
     * @group  unit:survey
     * @group  unit:survey:service
     * @group  unit:survey:service:report
     * @return void
     */
    public function a_user_can_retrieve_the_list_of_available_months_from_the_reports_table()
    {
        // Arrangements
        $service = app(ReportServiceInterface::class);

        factory(Report::class, 2)->create(['remarks' => '02-2020']);
        factory(Report::class, 2)->create(['remarks' => '03-2020']);

        // Actions
        $actual = $service->getMonths();

        // Assertions
        $this->assertIsArray($actual);
        $this->assertTrue(2 == count($actual));
    }
}
