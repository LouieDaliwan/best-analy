<?php

namespace Best\Pro;
use Illuminate\Support\Str;

class KeyEnablers
{
    /**
     * Retrieve comment via keyword.
     *
     * @param  string code
     * @param  string month
     * @param  Illuminate\Support\Collection fields
     * @return string
     */
    public static function getDescription($codem $month, $fields)
    {
        $code = strtolower($code);
        $comment = '';

        switch ($code) {
            case 'fmpi':
                $comment = trans("best::enablers/fmpi.description");
                break;

            case 'bspi':
                $comment = trans("best::enablers/bspi.description");
                break;

            case 'hrpi':
                $comment = trans("best::enablers/hrpi.description");
                break;

            case 'pmpi':
                $comment = trans("best::enablers/pmpi.description");
                break;
        }

        return $comment;
    }

}
