<?php

namespace Tests;

abstract class ApiTestCase extends TestCase
{
    /**
     * Save a fake model via factory.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($attributes = [])
    {
        if ($this->hasStates()) {
            return factory($this->model())->states($this->getStates())->create($attributes);
        }

        return factory($this->model())->create($attributes);
    }

    /**
     * Generate a fake model via factory.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function make($attributes = [])
    {
        if ($this->hasStates()) {
            return factory($this->model())->states($this->getStates())->make($attributes);
        }

        return factory($this->model())->make($attributes);
    }
}
