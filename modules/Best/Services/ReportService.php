<?php

namespace Best\Services;

use Best\Models\Report;
use Core\Application\Service\Service;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Index\Models\Index;
use Survey\Models\Survey;

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
     * Create model resource.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Generate the survey report.
     *
     * @param  \Survey\Models\Survey $survey
     * @param  array                 $attributes
     * @return mixed
     */
    public function generate(Survey $survey, array $attributes)
    {
        $customer = Customer::find($attributes['customer_id']);
        $taxonomy = Index::find($attributes['taxonomy_id']);

        $reports = $this->model()->whereCustomerId(
            $customer->getKey()
        )->whereTaxonomyId(
            $taxonomy->getKey()
        )->get();

        $groups = $reports->groupBy('group')->map(function ($g) {
            return $g->avg('value');
        });

        return $groups;
    }
}
