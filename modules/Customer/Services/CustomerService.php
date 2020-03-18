<?php

namespace Customer\Services;

use Core\Application\Service\Concerns\HaveAuthorization;
use Core\Application\Service\Service;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;

class CustomerService extends Service implements CustomerServiceInterface
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
     * Property to check if model is ownable
     *
     * @var boolean
     */
    protected $ownable = true;

    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * Constructor to bind model to a repository.
     *
     * @param \Customer\Models\Customer $model
     * @param \Illuminate\Http\Request  $request
     */
    public function __construct(Customer $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Define the validation rules for the model.
     *
     * @param  integer|null $id
     * @return array
     */
    public function rules($id = null): array
    {
        return [
            'name' => 'required|max:255',
            'refnum' => 'required|max:255',
            'code' => ['required', 'max:255', Rule::unique($this->getTable())->ignore($id)],
            'user_id' => 'required|numeric',
        ];
    }

    /**
     * Update or Create attributes from CRM.
     *
     * @param  array $attributes
     * @return \Customer\Models\Customer
     */
    public function saveFromCrm($attributes)
    {
        return $this->model()->updateOrCreate([
            'refnum' => $attributes['refnum'] ?? null,
        ], $attributes);
    }

    /**
     * Retrieve all customer reports and
     * return a paginated list.
     *
     * @param  \Customer\Models\Customer $customer
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listReports(Customer $customer)
    {
        $this->model = $customer->reports();

        if ($this->isSearching()) {
            $this->model = $this->whereIn(
                $this->getKeyName(), $this->search(
                    $this->request()->get('search')
                )->keys()->toArray()
            );
        }

        $model = $this->model->paginate($this->getPerPage());

        $sorted = $this->sortAndOrder($model);

        return new LengthAwarePaginator($sorted, $model->total(), $model->perPage());
    }
}
