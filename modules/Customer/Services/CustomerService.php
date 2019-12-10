<?php

namespace Customer\Services;

use Core\Application\Service\Service;
use Illuminate\Http\Request;
use Customer\Models\Customer;

class CustomerService extends Service implements CustomerServiceInterface
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
     * @param \Customer\Models\Customer $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Customer $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}
