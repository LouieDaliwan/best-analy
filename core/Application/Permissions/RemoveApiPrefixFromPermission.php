<?php

namespace Core\Application\Permissions;

trait RemoveApiPrefixFromPermission
{
    /**
     * Parse the permission code and remove
     * api prefixes if any.
     *
     * @param  string $permission
     * @return string
     */
    protected function removeApiPrefixFromPermission($permission): string
    {
        return str_replace('api.', '', $permission);
    }
}
