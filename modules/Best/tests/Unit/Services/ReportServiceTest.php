<?php

namespace Survey\Unit\Services;

use Best\Models\Report;
use Best\Services\FormulaServiceInterface;
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
        $service = app(FormulaServiceInterface::class);
        $attributes = factory(Report::class)->make()->toArray();

        // Actions
        $attributes = array_merge($attributes, [
            'metadata' => json_encode([
                'subscore' => $this->faker->randomDigitNotNull(),
                'average' => number_format($this->faker->randomDigitNotNull(), 2),
            ]),
        ]);
        $actual = $service->store($attributes);

        // Assertions
        $this->assertDatabaseHas($service->getTable(), $attributes);
    }
}
