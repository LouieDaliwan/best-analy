<?php

namespace Customer\Support\Crm\Contracts;

use Customer\Support\Crm\FileNumber;

interface CrmInterface
{
    /**
     * Retrieve the GET url of the
     * CRM API endpoint.
     *
     * @param  \Customer\Support\Crm\FileNumber $fileNumber
     * @return object|mixed
     */
    public function get(FileNumber $fileNumber):? object;

    /**
     * Retrieve the POST url of the
     * CRM API endpoint.
     *
     * @param  array $attributes
     * @return object|mixed
     */
    public function post(array $attributes):? object;
}
