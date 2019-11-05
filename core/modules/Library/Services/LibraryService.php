<?php

namespace Library\Services;

use Core\Application\Service\Service;
use Illuminate\Http\Request;
use Library\Models\Library;

class LibraryService extends Service implements LibraryServiceInterface
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
     * @param  \Library\Models\Library  $model
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Library $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}
