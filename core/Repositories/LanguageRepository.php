<?php

namespace Core\Repositories;

use Illuminate\Config\Repository as ConfigRepository;

class LanguageRepository extends ConfigRepository
{
    /**
     * All of the configuration items.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Create a new configuration repository.
     *
     * @param  array $items
     * @return void
     */
    public function __construct(array $items = [])
    {
        $this->items = array_merge($this->items, $items);
    }
}
