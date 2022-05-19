<?php

namespace Customer\Services;

use Best\Models\Report;
use Core\Application\Service\Concerns\HaveAuthorization;
use Core\Application\Service\Service;
use Customer\Jobs\ComputeFinancialRatio;
use Customer\Jobs\UpdateStatementsJob;
use Customer\Models\Customer;
use Customer\Models\FinancialStatement;
use Customer\Services\FinancialRatioInterface;
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

        if ($exist_customer) {
            $exist_customer->name = $attributes['name'];
            $exist_customer->metadata = $this->updateMetadata($exist_customer, $attributes);
            $exist_customer->refnum = $attributes['refnum'];
            $exist_customer->status = $attributes['status'];
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
    }

    /**
     *  Check the code if exists
     * @param  string $slug
     * @param  int    $i
     * @return object
     * @author Louie Daliwan
     */
    protected function checkCode($slug, $i = 0)
    {
        do {
            $text = $i == 0 ? Str::slug($slug) : sprintf('%s-%s', Str::slug($slug), $i);

            if (! $this->whereCode($text)->exists()) {
                return null;
            }

            $customer = $this->model->where('code', $text)
                ->whereUserId(auth()->user()->id)
                ->first();

            $i++;
        } while (is_null($customer));

        return $customer;
    }

    /**
     *  Update only specific keys on metadata
     * @param  object $customer
     * @return array
     * @author Louie Daliwan
     */
    protected function updateMetadata($customer, $attributes)
    {
        $metadata = $customer->metadata;

        $metadata['FileNo'] = $attributes['metadata']['FileNo'];
        $metadata['FundingRequestNo'] = $attributes['metadata']['FundingRequestNo'];
        $metadata['SiteVisitDate'] = $attributes['metadata']['SiteVisitDate'];
        $metadata['BusinessCounselorName'] = $attributes['metadata']['BusinessCounselorName'];
        $metadata['PeeBusinessCounselorName'] = $attributes['metadata']['PeeBusinessCounselorName'];

        return $metadata;
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

    /**
     * Check if the metadata financial statement have value
     * @param  array $attributes
     * @author Louie Daliwan
     * @return array
     */
    public function checkFinancialStatementMetadata($attributes)
    {
        $keys = ['fps-qa1','balance-sheet'];

        $years = ['Year1', 'Year2', 'Year3'];

        $count_values = 0;

        foreach ($keys as $key) {

            $count = 0;

            foreach ($attributes['metadata'][$key] as $field => $value) {

                if ($attributes['metadata'][$key][$field][$years[$count]] != null) {
                    $count_values++;
                }

                $count++;

                if($years[$count] == 'Year3') {
                    $count = 0;
                }
            }
        }

        $attributes['is_fs_has_no_zero_value'] = $count_values !=  0 ? true : false;
        return $attributes;
    }


    /**
     * Save the details of Customer/Company

     * @param array $attributes
     * @param int   $id
     */
    public function updateDetails($id, $attributes)
    {
        $customer = $this->model->find($id);

        $this->saveCustomerDetail($customer, $attributes);

        if (isset($attributes['metadata']['applicant'])) {
            $customer->applicant()->updateOrCreate(
                ['customer_id' => $id],
                ['metadata' => $attributes['metadata']['applicant']]
            );
        }
        
        if(isset($attributes['metadata']['project'])) {
            $customer->detail()->updateOrCreate(
                ['customer_id' => $id],
                ['metadata' => $attributes['metadata']['project']]
            );

            dispatch(new UpdateStatementsJob($customer));
            //add new job? for update the computation of financial statement?
        }
        
        $statements = $attributes['metadata']['statement'] ?? null;

        if ( isset($statements['metadataStatements']) && isset($statements['metadataSheets']) && $statements['metadataStatements']['period'] != null) {
            app(FinancialRatioInterface::class)->compute($customer, $statements);
        }
    }

    protected function saveCustomerDetail($customer, $attributes)
    {
        $customer->name = $attributes['name'];
        $customer->code = $attributes['code'];
        $customer->refnum = $attributes['refnum'];
        $customer->save();
    }

    public function financialRatios($customer)
    {
        //Todo optimize
        $latestPeriod = FinancialStatement::where('customer_id', $customer->id)->orderBy('period', 'desc')->first();

        if (is_null($latestPeriod) || is_null($latestPeriod->metadataResults)) {
            $emptyDash = config('fratio')['format']['dashboard'];
            
            $emptyDash['date'] = 'empty';
            
            return $emptyDash;
        }

        return $latestPeriod->metadataResults['ratioAnalysis']['dashboard'];
    }
}
