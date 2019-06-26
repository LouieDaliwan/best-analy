<?php

namespace Core\Application\Service;

use Core\Application\Service\Service;

trait WithService
{
    /**
     * The service attribute.
     *
     * @var \Core\Application\Service\Service
     */
    protected $service;

    /**
     * Retrieve the service instance.
     *
     * @return \Core\Application\Service\Service
     * @throws \Exception Throws a service not found error.
     */
    public function service()
    {
        return $this->service;
        if ($this->service instanceof Service) {
        }

        throw new \Exception("{$this->service} is not instance of \Core\Application\Service\Service.", 1);
    }
}
