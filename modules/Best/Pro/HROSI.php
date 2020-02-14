<?php

namespace Best\Pro;

abstract class HROSI
{
    /**
     * Retrieve the equivalent text of above 90 points.
     *
     * @return string
     */
    public static function above90()
    {
        return trans('best.hrosi.above90')
    }
}
