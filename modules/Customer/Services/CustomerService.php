<?php

namespace Customer\Services;

use Best\Models\Report;
use Core\Application\Service\Concerns\HaveAuthorization;
use Core\Application\Service\Service;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
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
        $exist_customer = $this->checkCode(Str::slug($attributes['code']));

        if($exist_customer) {

            $exist_customer->name = $attributes['name'];
            // $exist_customer->metadata = $attributes['metadata'];
            $exist_customer->refnum = $attributes['refnum'];
            // $exist_customer->status = $attributes['status'];
            // $exist_customer->user_id = $attributes['user_id'];
            $exist_customer->token = $attributes['token'];
            $exist_customer->save();

            return $exist_customer;

        } else {

            return Customer::firstOrCreate([
                'name' => $attributes['name'],
                'metadata' => $attributes['metadata'],
                'refnum' => $attributes['refnum'],
                'status' => $attributes['status'],
                'user_id' => $attributes['user_id'],
                'token' => $attributes['token'],
                'code' => $this->handleCode(Str::slug($attributes['code']))
            ]);
        }

        // return Customer::updateOrCreate([
        //     'code' => $this->handleCode(Str::slug($attributes['code'])),
        //     'refnum' => $attributes['refnum'],
        // ], $attributes);
    }

    /**
     *  Check the code if exist
     *  @param string $slug
     *  @return object
     *  @author Louie Daliwan
     */
    protected function checkCode($slug, $i = 0)
    {
        do {
            $text = $i == 0 ? Str::slug($slug) : sprintf('%s-%s', Str::slug($slug), $i);

           $customer = Customer::where('code', $text)
            ->where('user_id',  auth()->user()->id)
            ->first();

            $i++;
        } while (is_null($customer));

        return $customer;
    }

    /**
     * Validate and sanitize slug.
     *
     * @param  string  $slug
     * @param  integer $i
     * @return string
     */
    public function handleCode($slug, $i = 0)
    {
        $text = $slug;

        if ($this->whereCode($text)->exists()) {
            do {
                $text = sprintf('%s-%s', Str::slug($slug), ++$i);
            } while ($this->whereCode($text)->exists());
        }

        return $text;
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
        $report = new Report;

        if ($this->isSearching()) {
            $this->model = $this->whereIn(
                'id', $report->search(
                    $this->request()->get('search')
                )->keys()->toArray()
            );
        }

        $model = $this->model->whereUserId($this->auth()->id());

        $monthVar = explode('-', $this->request()->get('month') ?? '');

        $month = $this->request()->get('month') ? $monthVar[0] : date('m');
        $model = $model->whereMonth('remarks', $month);

        $year = $this->request()->get('month') ? $monthVar[1] : date('Y');
        $model = $model->whereYear('remarks', $year);

        $model = $model->paginate($this->getPerPage());

        $sorted = $this->sortAndOrder($model);

        return new LengthAwarePaginator($sorted, $model->total(), $model->perPage());
    }
}
