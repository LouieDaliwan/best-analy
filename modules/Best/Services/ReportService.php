<?php

namespace Best\Services;

use Best\Events\ReportGenerated;
use Best\Models\Report;
use Best\Pro\Financial\EfficiencyAnalysis;
use Best\Pro\Financial\FinancialRatios;
use Best\Pro\Financial\LiquidityAnalysis;
use Best\Pro\Financial\ProductivityAnalysis;
use Best\Pro\Financial\ProductivityIndicators;
use Best\Pro\Financial\ProfitabilityAnalysis;
use Best\Pro\Financial\SolvencyAnalysis;
use Best\Pro\KeyStrategicRecommendationComments;
use Best\Pro\TrafficLight;
use Core\Application\Service\Service;
use Customer\Http\Resources\ReportResource;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Index\Models\Index;
use Spatie\Browsershot\Browsershot;
use Survey\Models\Survey;
use User\Models\User;

class ReportService extends Service implements ReportServiceInterface
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
     * The collection of reports.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $reports;

    /**
     * The arrya of data extracted from report.
     *
     * @var array
     */
    protected $data;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \Best\Models\Report      $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Report $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Permanently delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function delete($id)
    {
        $this
            ->model()
            ->whereIn($this->model()->getKeyName(), (array) $id)
            ->get()->each(function ($resource) {
                $resource->forceDelete();
            });
    }

    /**
     * Retrieve list of reports from given user and customer.
     *
     * @param  \User\Models\User         $user
     * @param  \Customer\Models\Customer $customer
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function onlyFromUser(User $user, Customer $customer)
    {
        if ($this->isSearching()) {
            $this->model = $this->whereIn(
                $this->getKeyName(), $this->search(
                    $this->request()->get('search')
                )->keys()->toArray()
            );
        }

        $model = $this->model->whereUserId($user->getKey())->whereCustomerId($customer->getKey());

        $model = $model->whereRemarks($this->request()->get('month') ?: date('m-Y'));

        $model = $model->paginate($this->getPerPage());

        $sorted = $this->sortAndOrder($model);

        return new LengthAwarePaginator($sorted, $model->total(), $model->perPage());
    }

    /**
     * Retrieve the list of available months.
     *
     * @return array
     */
    public function getMonths()
    {
        $model = $this->model->groupBy('remarks')->pluck('remarks');

        return $model->map(function ($item) {
            $month = date('d-m-Y', strtotime("01-$item"));
            return ['value' => $item, 'text' => date('M Y', strtotime($month))];
        })->toArray();
    }

    /**
     * Retrieve list of reports from given user and customer.
     *
     * @param  \User\Models\User         $user
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getOverallReportFromUser(User $user, Customer $customer)
    {
        $model = $this->model->whereUserId($user->getKey())->whereCustomerId($customer->getKey());

        $model = $model->whereRemarks($this->request()->get('month') ?: date('m-Y'));

        return [
            'report' => new ReportResource($model->first()),
            'customer' => $customer,
        ];
    }

    /**
     * Retrieve list of reports from given user and customer.
     *
     * @param  \User\Models\User         $user
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getFinancialRatiosFromUser(User $user, Customer $customer)
    {
        $model = $this->model->whereUserId($user->getKey())->whereCustomerId($customer->getKey());

        $model = $model->whereRemarks($this->request()->get('month') ?: date('m-Y'));

        return [
            'report' => $model->first(),
            'customer' => $customer,
        ];
    }
}
