<?php

namespace Best\Pro;

abstract class TrafficLight
{
    const RED_LIGHT = 'red';
    const AMBER_LIGHT = 'amber';
    const GREEN_LIGHT = 'green';
    const RED_LIGHT_KEYWORD = 'short term';
    const AMBER_LIGHT_KEYWORD = 'medium term';
    const GREEN_LIGHT_KEYWORD = 'maintain';

    /**
     * Retrieve the array of scores.
     *
     * @return array
     */
    public static function grades(): array
    {
        return config('modules.best.scores.grades', []);
    }

    /**
     * Retrieve the value of red.
     *
     * @return float|mixed
     */
    public static function red()
    {
        return self::grades()[self::RED_LIGHT];
    }

    /**
     * Retrieve the value of amber.
     *
     * @return float|mixed
     */
    public static function amber()
    {
        return self::grades()[self::AMBER_LIGHT];
    }

    /**
     * Retrieve the value of green.
     *
     * @return float|mixed
     */
    public static function green()
    {
        return self::grades()[self::GREEN_LIGHT];
    }

    /**
     * Retrieve the traffic light value of the given score.
     *
     * @param  float|integer $score
     * @return string
     */
    public static function closest($score)
    {
        $closest = null;
        if ($score > self::amber()) {
            if ($score > self::green()) {
                $closest = self::GREEN_LIGHT;
            } else {
                $closest = self::AMBER_LIGHT;
            }
        } else {
            $closest = self::RED_LIGHT;
        }
        return $closest;
    }

    /**
     * Retrieve the equivalent traffic light comment.
     *
     * @param  integer $total
     * @param  string  $code
     * @param  string  $name
     * @return string
     */
    public static function getTrafficLightComment($total, $code, $name): string
    {
        $comment = '';

        if ($total > config('best.scores.red')) {
            if ($total > config('best.scores.amber')) {
                $comment = trans("best::comments.{$code}.above90", ['name' => $name]);
            } else {
                $comment = trans("best::comments.{$code}.mid50to89", ['name' => $name]);
            }
        } else {
            $comment = trans("best::comments.{$code}.below50", ['name' => $name]);
        }

        return $comment;
    }
}
