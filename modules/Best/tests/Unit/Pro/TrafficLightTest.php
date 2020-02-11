<?php

namespace Best\Tests\Unit\Pro;

use Best\Pro\TrafficLight;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @package Best\Tests\Unit\Pro
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class TrafficLightTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     * @group  unit
     * @group  unit:best
     * @group  unit:best:pro
     * @return void
     */
    public function it_can_retrieve_the_array_of_grades()
    {
        // Arrangements
        $grades = TrafficLight::grades();

        // Assertions
        $this->assertIsArray($grades);
        $this->assertEquals(config('modules.best.scores.grades', []), $grades);
    }

    /**
     * @test
     * @group  unit
     * @group  unit:best
     * @group  unit:best:pro
     * @return void
     */
    public function it_can_retrieve_the_closest_value_from_traffic_lights_grades_array()
    {
        // Arrangements
        $expected = null;
        $grades = TrafficLight::grades();
        $score = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 2);

        $closest = null;

        if ($score > TrafficLight::amber()) {
            if ($score > TrafficLight::green()) {
                $closest = TrafficLight::GREEN_LIGHT;
            } else {
                $closest = TrafficLight::AMBER_LIGHT;
            }
        } else {
            $closest = TrafficLight::RED_LIGHT;
        }

        // Actions
        $actual = TrafficLight::closest($score);
        $expected = $closest;

        // Assertions
        $this->assertEquals($expected, $actual);
    }
}
