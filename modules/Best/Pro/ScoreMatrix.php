<?php

namespace Best\Pro;

abstract class ScoreMatrix
{
    const SCORES_LIST = [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 0,
    ];

    /**
     * Retrieve the score value from the given key.
     *
     * @param  string $key
     * @return string|integer
     */
    public static function getScoreFromKey($key)
    {
        return self::SCORES_LIST[$key] ?? 0;
    }
}
