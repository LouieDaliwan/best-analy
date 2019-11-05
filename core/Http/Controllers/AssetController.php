<?php

namespace Core\Http\Controllers;

use Core\Repositories\Contracts\AssetRepositoryInterface;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Initialize the repository instance.
     *
     * @param \Core\Repositories\Contracts\AssetRepositoryInterface $repository
     */
    public function __construct(AssetRepositoryInterface $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    /**
     * Retrieve the file from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $file
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request, $file = '')
    {
        return $this->repository()->fetch($file);
    }
}
