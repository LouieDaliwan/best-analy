<?php

namespace Best\Unit\Pro;

use Best\Pro\ScoreMatrix;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @package Best\Unit\Pro
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ScoreMatrixTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     * @group  unit
     * @group  unit:best
     * @group  unit:best:pro
     * @return void
     */
    public function it_can_retrieve_the_score_from_key()
    {
        // Arrangements
        $key = $this->faker->numberBetween($min = 0, $max = 7);
        $expected = ScoreMatrix::SCORES_LIST[$key] ?? 0;

        // Actions
        $actual = ScoreMatrix::getScoreFromKey($expected);

        // Assertions
        $this->assertEquals($expected, $actual);
    }
}
