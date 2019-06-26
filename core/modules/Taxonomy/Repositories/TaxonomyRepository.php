<?php

namespace Taxonomy\Repositories;

use Core\Application\Repository\Repository;
use Illuminate\Http\Request;
use Taxonomy\Models\Taxonomy;

class TaxonomyRepository extends Repository
{
    /**
     * The property on class instances.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \Illuminate\Database\Eloquent\Model $taxonomy
     * @param \Illuminate\Http\Request $user
     */
    public function __construct(Taxonomy $taxonomy, Request $request)
    {
        $this->model = $taxonomy;

        $this->request = $request;
    }
}
