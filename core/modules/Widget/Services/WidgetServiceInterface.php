<?php

namespace Widget\Services;

use Core\Application\Service\ServiceInterface;

interface WidgetServiceInterface extends ServiceInterface
{
    /**
     * Retrieve the default widgets
     * from configuration files.
     *
     * @return \Illuminate\Support\Collection
     */
    public function defaults();
}
