<?php

namespace Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * The repository instance.
     *
     * @var \Core\Support\Repository\Repository
     */
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Retrieve the Repository instance.
     *
     * @return Core\Support\Repository\Repository
     */
    public function repository()
    {
        return $this->repository;
    }
}
