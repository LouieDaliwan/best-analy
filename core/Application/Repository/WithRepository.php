<?php

namespace Core\Application\Repository;

use Core\Application\Repository\Repository;

trait WithRepository
{
    /**
     * The repository attribute.
     *
     * @var \Core\Application\Repository\Repository
     */
    protected $repository;

    /**
     * Retrieve the repository instance.
     *
     * @return \Core\Application\Repository\Repository
     */
    public function repository():? Repository
    {
        return $this->repository ?? null;
    }
}
