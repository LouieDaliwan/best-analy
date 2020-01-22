<?php

namespace Core\Enumerations;

abstract class DetailType
{
    const ACCOUNT = 'account';
    const BIODATA = 'biodata';
    const FAVORITE = 'favorite';
    const DETAIL = 'detail';

    /**
     * Retrieve all sensitive detail types.
     *
     * @return array
     */
    public static function sensitive(): array
    {
        return [
            self::ACCOUNT,
        ];
    }
}
