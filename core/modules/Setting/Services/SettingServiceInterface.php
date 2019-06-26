<?php

namespace Setting\Services;

use Illuminate\Contracts\Config\Repository as RepositoryInterface;

interface SettingServiceInterface extends RepositoryInterface
{
    /**
     * Filter the items through regex with the given string.
     *
     * @param  string $key
     * @return mixed
     */
    public function containsKey($key);
}
