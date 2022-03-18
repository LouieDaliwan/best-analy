<?php

namespace Best\Services;

use Best\Events\ReportGenerated;
use Best\Models\Report;
use Best\Pro\Financial\EfficiencyAnalysis;
use Best\Pro\Financial\FinancialRatios;
use Best\Pro\Financial\LiquidityAnalysis;
use Best\Pro\Financial\ProductivityAnalysis;
use Best\Pro\Financial\ProductivityIndicators;
use Best\Pro\Financial\ProfitAndLossStatement;
use Best\Pro\Financial\ProfitabilityAnalysis;
use Best\Pro\Financial\SolvencyAnalysis;
use Best\Pro\KeyStrategicRecommendationComments;
use Best\Pro\TrafficLight;
use Core\Application\Service\Service;
use Customer\Http\Resources\AllCustomerResource;
use Customer\Http\Resources\CustomerResource;
use Customer\Http\Resources\ReportResource;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Index\Models\Index;
use Library\Models\Library;
use Setting\Models\Setting;
use Spatie\Browsershot\Browsershot;
use Survey\Models\Survey;
use User\Models\User;
use Illuminate\Support\Facades\File;
use Barryvdh\Snappy\Facades\SnappyPdf;

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

        $model = $model->where('month', $this->request()->get('month') ?: date('m-Y'));

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
        $model = $this->model->groupBy('month')->pluck('month');

        return $model->reject(function ($item) {
            return is_null($item);
        })->map(function ($item) {
            $month = date('d-m-Y', strtotime("01-{$item}"));
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

        $date = $this->request()->get('month') != 'null'  ?  $this->request()->get('month') : date('m-Y');

        if (is_null($date)) {
            $date = date('m-Y');
        }

        $model = $model->where('month', $date);

        if (! $model->exists()) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        $model = new ReportResource($model->latest('updated_at')->first());

        $remarks = $model->month;
        $path = Library::where('name', "overall:report:$remarks")->first();

        $financialReportPath = Library::where('name', "overall:financialratio:$remarks")->first();

        return [
            'overall:report' => $path ? Report::encodeToBase64(storage_path($path->pathname)) : null,
            'report:financial' => $financialReportPath ? Report::encodeToBase64(storage_path($financialReportPath->pathname)) : null,
            'report' => $model,
            'customer' => new CustomerResource($customer),
            'profit_and_loss' => ProfitAndLossStatement::getReport($customer),
            'overall:comment' => Setting::whereUserId($user->getKey())
                ->whereKey("overall:comment/".$customer->getKey().$model->month)
                ->first()->value ?? null,
        ];
    }

    /**
     * Retrieve list of reports from given user and customer.
     *
     * @param  \User\Models\User         $user
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getFinancialRatio(User $user, Customer $customer)
    {
        $month = date('m-Y');
        $date = date('Y-m-d');
        $hash = date('d-m-Y');
        $refnum = $customer->refnum;
        $type = 'financialratio';
        $name = 'Financial Analysis';
        $name = "$name Report - {$refnum}-{$hash}";

        $data = app(FormulaFinancialRatioInterface::class)->generateRatio($customer, $user);

        $html = view("best::reports.pdf.$type", ['data' => $data])->render();

        if (! File::exists(storage_path("modules/reports/$date"))) {
            File::makeDirectory(storage_path("modules/reports/$date"), 0755, true, true);
        }

        file_put_contents(storage_path("modules/reports/$date/$name.html"), $html);

        $pdf = SnappyPdf::loadFile(storage_path("modules/reports/$date/$name.html"));

        $path = storage_path("modules/reports/$date/$name.pdf");

        if (file_exists($path)) {
            File::delete($path);
        }

        if (! file_exists($path)) {
            $pdf
                ->setPaper('legal')
                ->setOption('enable-javascript', true)
                ->setOption('javascript-delay', 2000)
                ->setOption('debug-javascript', true)
                ->save($path);
        }

        $financialReportPath = Library::updateOrCreate([
            'name' => "overall:financialratio:$month",
        ], [
            'pathname' => "modules/reports/$date/$name.pdf",
            'url' => url("modules/reports/$date/$name.pdf"),
        ]);

        return [
            'report:financial' => $financialReportPath ? Report::encodeToBase64(storage_path($financialReportPath->pathname)) : null,
            'customer' => new CustomerResource($customer),
            'profit_and_loss' => ProfitAndLossStatement::getReport($customer),
            'date' => date('Y-m-d'),
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

        // $model = $model->whereRemarks($this->request()->get('month') ?: date('m-Y'));

        dd($model);
        return [
            'report' => $model->first(),
            'customer' => new AllCustomerResource($customer),
        ];
    }
}
