<?php

namespace Survey\Services;

use Core\Application\Service\Service;
use Illuminate\Http\Request;
use Survey\Models\Field;

class FieldService extends Service implements FieldServiceInterface
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
     * @param \Survey\Models\Field     $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Field $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}
