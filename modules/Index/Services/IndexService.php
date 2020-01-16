<?php

namespace Index\Services;

use Core\Application\Service\Concerns\HaveAuthorization;
use Illuminate\Http\Request;
use Index\Models\Index;
use Taxonomy\Services\TaxonomyService;

class IndexService extends TaxonomyService implements IndexServiceInterface
{
    use HaveAuthorization;

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
     * Property to check if model is ownable.
     *
     * @var boolean
     */
    protected $ownable = true;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \Index\Models\Index      $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Index $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}
