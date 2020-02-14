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

        $this->reports = $this->model()->whereCustomerId(
            $customer->getKey()
        )->whereTaxonomyId(
            $taxonomy->getKey()
        )->whereFormId(
            $survey->getKey()
        )->whereUserId(
            user()->getKey()
        )->get();

        $this->data[$survey->code] = [
            'pindex' => $taxonomy->name,
            'group' => $this->getGroupedAverage(),
            'total' => $total = $this->getTotalAverage($survey),
            'comment' => $this->getPerformanceIndexComment(
                $taxonomy->code, $customer->name, $total
            ),
        ];

        return $this->data;
    }

    /**
     * Retrieve the collected grouped average.
     *
     * @return mixed
     */
    public function getGroupedAverage()
    {
        return $this->reports->groupBy('group')->map(function ($g) {
            return $g->avg('value');
        });
    }

    /**
     * Retrieve the group's average total.
     *
     * @param  Survey\Models\Survey $survey
     * @return mixed
     */
    public function getTotalAverage(Survey $survey)
    {
        $submissions = $survey->fields->map(function ($field) {
            return $field->submissionBy(user());
        })->sum('results');

        $total = $survey->fields->map(function ($field) {
            return $field->metadata['total'] ?? 0;
        })->sum() ?: 1;

        return ($submissions/$total)*100;
    }

    /**
     * Retrieve the overall comment.
     *
     * @param  string $code
     * @param  string $customer
     * @param  float  $total
     * @return mixed
     */
    protected function getPerformanceIndexComment($code, $customer, $total)
    {
        $total = $total/100;
        $comment = null;
        $code = strtolower($code);

        if ($total > config('best.scores.red')) {
            if ($total > config('best.scores.amber')) {
                $comment = trans("best::comments.{$code}.above90", ['name' => $customer]);
            } else {
                $comment = trans("best::comments.{$code}.mid50to89", ['name' => $customer]);
            }
        } else {
            $comment = trans("best::comments.{$code}.below50", ['name' => $customer]);
        }

        return $comment;
    }
}
