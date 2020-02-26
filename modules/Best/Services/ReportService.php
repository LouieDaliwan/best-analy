<?php

namespace Best\Services;

use Anam\PhantomMagick\Converter as PdfConverter;
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
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
     * Download the array as pdf.
     *
     * @param  array $attributes
     * @return mixed
     */
    public function download($attributes)
    {
        $type = $attributes['rtype'] ?? 'index';

        if ($type == 'overall') {
            $render = view("best::reports.{$type}")->withData(array_merge(
                $attributes
            ))->render();
        } else {
            $render = view("best::reports.{$type}")->withData(array_merge(
                $attributes,
                $attributes['indices'][$attributes['pcode'] ?? null] ?? []
            ))->render();
        }

        $pdf = new PdfConverter;
        $pdf->setBinary(base_path('bin/phantomjs'));
        $pdf->addPage($render)
          ->format('Legal')
          ->toPdf();

        return $pdf->download();
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
        $taxonomies = Index::all();

        // Retrieve the Customer array.
        $this->data['organisation:profile'] = $customer->toArray();

        // Retrieve Performance Indices data.
        foreach ($taxonomies as $i => $taxonomy) {
            $survey = $taxonomy->survey;

            if (is_null($survey)) {
                break;
            }

            $this->reports = $this->model()->whereCustomerId(
                $customer->getKey()
            )->whereTaxonomyId(
                $taxonomy->getKey()
            )->whereFormId(
                $survey->getKey()
            )->whereUserId(
                $this->auth()->user()->getKey()
            )->get();

            $this->data['indices'][$taxonomy->alias] = [
                'pindex' => $taxonomy->name,
                'pindex:code' => $taxonomy->alias,
                'pindex:description' => $taxonomy->description,
                'pindex:weightage' => $taxonomy->metadata['weightage'] ?? 0,
                'survey:code' => $survey->code,
                'elements' => $group = $this->getGroupedAverage(),
                'elements:charts' => $this->getChartedGroupedAverage($group),
                'cover:date' => date(settings('formal:date', 'Y-m-d')),
                'cover:description' => $taxonomy->metadata['report:description'] ?? null,
                'customer:name' => $customer->name,
                'customer:refnum' => $customer->refnum,
                'customer:industry' => $customer->metadata['industry'] ?? null,
                'customer:staffstrength' => $customer->metadata['staffstrength'] ?? null,
                'subscore:score' => $totalSubscoreScore = $this->getTotalIndexSubscoreScore($survey),
                'subscore:total' => $totalSubscoreTotal = $this->getTotalIndexSubscoreTotal($survey),
                'overall:total' => $total = $this->getOverallTotalAverage($totalSubscoreScore, $totalSubscoreTotal),
                'overall:comment' => $this->getOverallFindingsComment($taxonomy->alias, $customer->name, $total),
                'box:comments' => [
                    $this->getFirstBoxComment($total, $group, $taxonomy->alias),
                    $this->getSecondBoxComment($total, $group, $taxonomy->alias),
                ],
                'key:enablers' => $enablers = $this->getKeyEnablers($this->reports, $customer->name, $taxonomy->alias),
                'key:recommendations' => $this->getKeyStrategicRecommendations($enablers, $taxonomy->alias),
            ];
        }//end foreach

        // Retrieve Overall BEST Score.
        $this->data['overall:score'] = $overallScore = $this->getOverallScore($this->data['indices']);
        $this->data['overall:percentage'] = sprintf('%s%%', $overallScore*100);
        $this->data['overall:result'] = $result = $this->getOverallTrafficLightScore($overallScore);
        $this->data['overall:comment'] = $this->getOverallComment($result, $customer->name);

        // Retrieve the metadata for the report cover.
        $this->data['cover:date'] = date(settings('formal:date', 'Y-m-d'));

        // Retrieve Financial Analysis data.
        $this->data['analysis:financial'] = $this->getFinancialAnalysisData();

        // Retrieve the Financial Ratios and Productivity Indicators.
        $this->data['ratios:financial'] = $this->getFinancialRatios($customer);
        $this->data['indicators:productivity'] = $this->getProductivityIndicators($customer);

        return $this->data;
    }

    /**
     * Retrieve the overall report score.
     *
     * @param  array $indices
     * @return string
     */
    public function getOverallScore($indices)
    {
        return round(collect($indices)->map(function ($index) {
            $avg = $index['subscore:score']/$index['subscore:total'];
            return $avg*$index['pindex:weightage'];
        })->sum(), 2);
    }

    /**
     * Retrieve the traffic light equivalent
     * of the overall score.
     *
     * @param  integer|float $score
     * @return string
     */
    public function getOverallTrafficLightScore($score)
    {
        return TrafficLight::getScoreLight($score);
    }

    /**
     * Retrieve the overall comment.
     *
     * @param  string $score
     * @param  string $customer
     * @return string
     */
    public function getOverallComment($score, $customer)
    {
        return trans("best::grading.$score", ['name' => $customer]);
    }

    /**
     * Retrieve the Financial Analysis data.
     *
     * @return array
     */
    public function getFinancialAnalysisData()
    {
        return [
            'profitability' => ProfitabilityAnalysis::getReport(),
            'liquidity' => LiquidityAnalysis::getReport(),
            'efficiency' => EfficiencyAnalysis::getReport(),
            'solvency' => SolvencyAnalysis::getReport(),
            'productivity' => ProductivityAnalysis::getReport(),
        ];
    }

    /**
     * Retrieve the Financial Ratios array.
     *
     * @return array
     */
    public function getFinancialRatios()
    {
        return FinancialRatios::getReport();
    }

    /**
     * Retrieve the productivity indicators.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getProductivityIndicators($customer)
    {
        return ProductivityIndicators::getReportWithCustomer($customer);
    }

    /**
     * Retrieve the recommendation comments.
     *
     * @param  array  $enablers
     * @param  string $index
     * @return array
     */
    public function getKeyStrategicRecommendations($enablers, $index)
    {
        $index = strtolower($index);

        foreach ($enablers['data'] as $enabler => $data) {
            $list = KeyStrategicRecommendationComments::get($enabler, $index);
            $icon = Str::slug($enabler);
            $recommendations[$enabler] = [
                'comment' => implode(' || ', (array) $list),
                'icon' => asset("reports/assets/icons/$icon.svg"),
            ];
        }

        return $recommendations;
    }

    /**
     * Retrieve the Key Enablers array.
     *
     * @param  Illuminate\Support\Collection $reports
     * @param  string                        $customer
     * @param  string                        $code
     * @return array
     */
    public function getKeyEnablers($reports, $customer, $code)
    {
        $code = strtolower($code);
        $documentation = $reports->map(function ($report) {
            return $report->reportable;
        })->filter(function ($submission) {
            return ($submission->submissible->metadata['Documentation'] ?? false)
                && $submission->submissible->metadata['Documentation'] == 'Y';
        });

        $talent = $reports->map(function ($report) {
            return $report->reportable;
        })->filter(function ($submission) {
            return ($submission->submissible->metadata['Talent'] ?? false)
                && $submission->submissible->metadata['Talent'] == 'Y';
        });

        $technology = $reports->map(function ($report) {
            return $report->reportable;
        })->filter(function ($submission) {
            return ($submission->submissible->metadata['Technology'] ?? false)
                && $submission->submissible->metadata['Technology'] == 'Y';
        });

        $workflow = $reports->map(function ($report) {
            return $report->reportable;
        })->filter(function ($submission) {
            return ($submission->submissible->metadata['Workflow Processes'] ?? false)
                && $submission->submissible->metadata['Workflow Processes'] == 'Y';
        });

        $documentationValue = round((($documentation->sum('results') ?: 0) / ($documentation->count() ?: 1) / 5) * 100);
        $talentValue = round((($talent->sum('results') ?: 0) / ($talent->count() ?: 1) / 10) * 100);
        $technologyValue = round((($technology->sum('results') ?: 0) / ($technology->count() ?: 1) / 10) * 100);
        $workflowValue = round((($workflow->sum('results') ?: 0) / ($workflow->count() ?: 1) / 10) * 100);

        $documentationComment = '';
        $documentationSubscore = $documentation->sortBy('metadata.subscore')->take(2)->values();
        if (($documentationValue/100) > config('modules.best.scores.grades.red')) {
            if (($documentationValue/100) > config('modules.best.scores.grades.amber')) {
                $documentationComment = trans("best::enablers/$code.documentation.50to90", [
                    'item1' => $documentationSubscore->get(0)->submissible->metadata['comment'] ?? null,
                ]);
            } else {
                $documentationComment = trans("best::enablers/$code.documentation.30to50", [
                    'item1' => $documentationSubscore->get(0)->submissible->metadata['comment'] ?? null,
                    'item2' => $documentationSubscore->get(1)->submissible->metadata['comment'] ?? null,
                ]);
            }
        } else {
            if (($documentationValue/100) < config('modules.best.scores.grades.nonlight')) {
                $documentationComment = trans("best::enablers/$code.documentation.less30");
            } else {
                $documentationComment = trans("best::enablers/$code.documentation.30to50", [
                    'item1' => $documentationSubscore->get(0)->submissible->metadata['comment'] ?? null,
                    'item2' => $documentationSubscore->get(1)->submissible->metadata['comment'] ?? null,
                ]);
            }
        }//end if

        $talentComment = '';
        $talentSubscore = $talent->sortBy('metadata.subscore')->take(2)->values();
        if (($talentValue/100) > config('modules.best.scores.grades.red')) {
            if (($talentValue/100) > config('modules.best.scores.grades.amber')) {
                $talentComment = trans("best::enablers/$code.talent.50to90", ['name' => $customer]);
            } else {
                $talentComment = trans("best::enablers/$code.talent.30to50", [
                    'item1' => $talentSubscore->get(0)->submissible->metadata['comment'] ?? null,
                    'item2' => $talentSubscore->get(1)->submissible->metadata['comment'] ?? null,
                ]);
            }
        } else {
            if (($talentValue/100) < config('modules.best.scores.grades.nonlight')) {
                $talentComment = trans("best::enablers/$code.talent.less30");
            } else {
                $talentComment = trans("best::enablers/$code.talent.30to50", [
                    'item1' => $talentSubscore->get(0)->submissible->metadata['comment'] ?? null,
                    'item2' => $talentSubscore->get(1)->submissible->metadata['comment'] ?? null,
                ]);
            }
        }//end if

        $technologyComment = '';
        $technologySubscore = $technology->sortBy('metadata.subscore')->take(3)->values();
        if (($technologyValue/100) > config('modules.best.scores.grades.red')) {
            if (($technologyValue/100) > config('modules.best.scores.grades.amber')) {
                $technologyComment = trans("best::enablers/$code.technology.50to90");
            } else {
                $technologyComment = trans("best::enablers/$code.technology.30to50", [
                    'name' => $customer,
                    'item1' => $technologySubscore->get(0)->submissible->metadata['comment'] ?? null,
                    'item2' => $technologySubscore->get(1)->submissible->metadata['comment'] ?? null,
                ]);
            }
        } else {
            if (($technologyValue/100) < config('modules.best.scores.grades.nonlight')) {
                $technologyComment = trans("best::enablers/$code.technology.less30");
            } else {
                $technologyComment = trans("best::enablers/$code.technology.30to50", [
                    'name' => $customer,
                    'item1' => $technologySubscore->get(0)->submissible->metadata['comment'] ?? null,
                    'item2' => $technologySubscore->get(1)->submissible->metadata['comment'] ?? null,
                    'item3' => $technologySubscore->get(2)->submissible->metadata['comment'] ?? null,
                ]);
            }
        }//end if

        $workflowComment = '';
        $workflowSubscore = $workflow->sortBy('metadata.subscore')->take(2)->values();
        if (($workflowValue/100) > config('modules.best.scores.grades.red')) {
            if (($workflowValue/100) > config('modules.best.scores.grades.amber')) {
                $workflowComment = trans("best::enablers/$code.workflow.50to90");
            } else {
                $workflowComment = trans("best::enablers/$code.workflow.30to50", [
                    'name' => $customer,
                    'item1' => $workflowSubscore->get(0)->submissible->metadata['comment'] ?? null,
                    'item2' => $workflowSubscore->get(1)->submissible->metadata['comment'] ?? null,
                ]);
            }
        } else {
            if (($workflowValue/100) < config('modules.best.scores.grades.nonlight')) {
                $workflowComment = trans("best::enablers/$code.workflow.less30");
            } else {
                $workflowComment = trans("best::enablers/$code.workflow.30to50", [
                    'name' => $customer,
                    'item1' => $technologySubscore->get(0)->submissible->metadata['comment'] ?? null,
                    'item2' => $technologySubscore->get(1)->submissible->metadata['comment'] ?? null,
                ]);
            }
        }//end if

        return [
            'chart' => [
                'labels' => ['Documentation', 'Talent', 'Technology', 'Workflow Processes'],
                'dataset' => [$documentationValue, $talentValue, $technologyValue, $workflowValue],
            ],
            'data' => [
                'Documentation' => [
                    'value' => $documentationValue,
                    'comment' => $documentationComment,
                ],
                'Talent' => [
                    'value' => $talentValue,
                    'comment' => $talentComment,
                ],
                'Technology' => [
                    'value' => $technologyValue,
                    'comment' => $technologyComment,
                ],
                'Workflow Processes' => [
                    'value' => $workflowValue,
                    'comment' => $workflowComment,
                ],
            ],
        ];
    }

    /**
     * Retrieve the box comments.
     *
     * @param  integer                       $total
     * @param  Illuminate\Support\Collection $group
     * @param  string                        $code
     * @return string|array
     */
    public function getFirstBoxComment($total, $group, $code)
    {
        $code = strtolower($code);

        $firstSentence = '';

        if ($group->avg() >= 1) {
            $firstSentence =  trans("best::comments.{$code}.100");
        } else {
            $fifthElement = $group->sort()->keys()->get(4);
            $fourthElement = $group->sort()->keys()->get(3);

            if ($group->sort()->get($fifthElement) == $group->sort()->get($fourthElement)) {
                $firstSentence = trans("best::comments.{$code}.first.based on responses", [
                    'item1' => $fifthElement, 'item2' => $fourthElement
                ]);
            } else {
                $firstSentence = trans("best::comments.{$code}.first.most well implemented", [
                    'item1' => $fifthElement
                ]);
            }

            if ($group->sort()->get($fifthElement) == $group->sort()->get($fourthElement)) {
                $firstSentence .= '';
            } else {
                $firstSentence .=  ' || '.trans("best::comments.{$code}.first.followed by", [
                    'name' => $fourthElement, 'score' => round(($group->sort()->get($fourthElement)*100)).'%'
                ]).' || '.trans("best::comments.{$code}.first.it is imperative");
            }
        }//end if

        return $firstSentence;
    }

    /**
     * Retrieve the box comments.
     *
     * @param  integer                       $total
     * @param  Illuminate\Support\Collection $group
     * @param  string                        $code
     * @return string|array
     */
    public function getSecondBoxComment($total, $group, $code)
    {
        $code = strtolower($code);
        $firstElement = $group->sort()->keys()->get(0);
        $secondElement = $group->sort()->keys()->get(1);

        return trans("best::comments.{$code}.second", [
            'item1' => $firstElement,
            'item2' => $secondElement,
        ]);
    }

    /**
     * Retrieve the collected grouped average.
     *
     * @return mixed
     */
    public function getGroupedAverage()
    {
        return $this->reports->groupBy('group')->map(function ($g) {
            return round($g->avg('value'), 2);
        });
    }

    /**
     * Prepare data for chart rendering.
     *
     * @param  array $group
     * @return array
     */
    public function getChartedGroupedAverage($group)
    {
        return [
            'labels' => $group->keys(),
            'data' => $group->values(),
        ];
    }

    /**
     * Get the total subscore of the index.
     *
     * @param  Survey\Models\Survey $survey
     * @return string
     */
    public function getTotalIndexSubscoreScore(Survey $survey)
    {
        return $survey->fields->map(function ($field) {
            return $field->submissionBy($this->auth()->user())->metadata['subscore'] ?? 0;
        })->sum();
    }

    /**
     * Get the total subscore of the survey.
     *
     * @param  Survey\Models\Survey $survey
     * @return string
     */
    public function getTotalIndexSubscoreTotal(Survey $survey)
    {
        return $survey->fields->map(function ($field) {
            return $field->metadata['total'] ?? 0;
        })->sum() ?: 1;
    }

    /**
     * Retrieve the group's average total.
     *
     * @param  integer $score
     * @param  integer $total
     * @return mixed
     */
    public function getOverallTotalAverage($score, $total)
    {
        return round(($score/$total)*100);
    }

    /**
     * Retrieve the overall comment.
     *
     * @param  string $code
     * @param  string $customer
     * @param  float  $total
     * @return mixed
     */
    protected function getOverallFindingsComment($code, $customer, $total)
    {
        $total = $total/100;
        $comment = null;
        $code = strtolower($code);

        if ($total > config('modules.best.scores.grades.red')) {
            if ($total > config('modules.best.scores.grades.amber')) {
                $comment = trans("best::overall.{$code}.above90", ['name' => $customer]);
            } else {
                $comment = trans("best::overall.{$code}.mid50to89", ['name' => $customer]);
            }
        } else {
            $comment = trans("best::overall.{$code}.below50", ['name' => $customer]);
        }

        return $comment;
    }
}
