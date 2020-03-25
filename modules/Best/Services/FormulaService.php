<?php

namespace Best\Services;

use Best\Models\Formula;
use Best\Pro\Enablers\OverallOrganisationEnablerMetrics;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Index\Models\Index;
use Spatie\Browsershot\Browsershot;
use Survey\Models\Survey;
use User\Models\User;

class FormulaService extends Service implements FormulaServiceInterface
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
     * @param \Best\Models\Formula     $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Formula $model, Request $request)
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
     * @param  \Best\Models\Report $report
     * @return mixed
     */
    public function download($report)
    {
        $type = $attributes['rtype'] ?? 'index';

        $html = view('best::reports.pdf')->withData(array_merge(
            $report->value,
            ['current:pindex' => $report->value['current:index'] ?? []]
        ))->render();

        return Browsershot::html($html)->pdf();
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
        $user = $this->auth()->user();

        // Retrieve the Customer array.
        $this->data['organisation:profile'] = $customer->toArray();
        $this->data['survey:id'] = $survey->getKey();
        $this->data['user:id'] = $user->getKey();

        // Retrieve Performance Indices data.
        foreach ($taxonomies as $i => $taxonomy) {
            $survey = $taxonomy->survey;
            $enablers = null;
            $this->reports = null;

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
                $user->getKey()
            )->get();

            $this->data['indices'][$taxonomy->alias] = [
                'taxonomy' => $taxonomy->toArray(),
                'page' => $i + 3,
                'pindex' => $taxonomy->name,
                'pindex:code' => $taxonomy->alias,
                'pindex:description' => $taxonomy->description,
                'pindex:weightage' => $taxonomy->metadata['weightage'] ?? 0,
                'pindex:icon' => $taxonomy->icon ?? '',
                'pindex:color' => $taxonomy->metadata['color'] ?? null,
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
                'overall:comment:overall' => $this->getOverallFindingsCommentOverall(
                    $taxonomy->alias, $customer->name, $total
                ),
                'box:comments' => [
                    $this->getFirstBoxComment($group, $taxonomy->alias),
                    $this->getSecondBoxComment($group, $taxonomy->alias),
                ],
                'key:enablers' => $enablers = $this->getKeyEnablers($this->reports, $customer->name, $taxonomy->alias),
                'key:enablers:description' => $this->getKeyEnablersDescription($taxonomy->alias),
                'key:recommendations' => $this->getKeyStrategicRecommendations($enablers, $taxonomy->alias),
                'has:reports' => $this->reports->count(),
                'reports' => $this->reports,
            ];
        }//end foreach

        // Retrieve Overall BEST Score.
        $this->data['overall:score'] = $overallScore = $this->getOverallScore($this->data['indices']);
        $this->data['overall:percentage'] = sprintf('%s%%', $overallScore*100);
        $this->data['overall:result'] = $result = $this->getOverallTrafficLightScore($overallScore);
        $this->data['overall:comment'] = $this->getOverallComment($result, $customer->name);
        $this->data['overall:enablers'] = $this->getOverallOrganisationEnablersMetricsComment(
            $this->data['indices'], $customer->name
        );
        $this->data['overall:enablers:orig'] = $this->getOriginalAverage($this->data['indices']);

        // Retrieve the metadata for the report cover.
        $this->data['cover:date'] = date(settings('formal:date', 'Y-m-d'));

        // Retrieve Financial Analysis data.
        $this->data['analysis:financial'] = $this->getFinancialAnalysisData($customer);

        // Retrieve the Financial Ratios and Productivity Indicators.
        $this->data['ratios:financial'] = $this->getFinancialRatios($customer);
        $this->data['indicators:productivity'] = $this->getProductivityIndicators($customer);

        $index = Index::find($attributes['taxonomy_id'] ?? false);
        if ($index) {
            $this->data['current:index'] = $this->data['indices'][$index->alias];
            $this->data['current:pindex'] = $this->data['indices'][$index->alias];
        }

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
        return trans("best::grading.$score", ['name' => $customer, 'appcode' => settings('app:code')]);
    }

    /**
     * Retrieve the 2 comments for overall organisation enablers metrics.
     *
     * @param  array  $indices
     * @param  string $name
     * @return array
     */
    public function getOverallOrganisationEnablersMetricsComment($indices, $name)
    {
        $indices = collect($indices)->map(function ($i) {
            return $i['key:enablers']['data'];
        });

        $documentationAvg = $indices->map(function ($i) {
            return $i['Documentation']['value']/100;
        })->avg();

        $talentAvg = $indices->map(function ($i) {
            return $i['Talent']['value']/100;
        })->avg();

        $technologyAvg = $indices->map(function ($i) {
            return $i['Technology']['value']/100;
        })->avg();

        $workflowAvg = $indices->map(function ($i) {
            return $i['Workflow Processes']['value']/100;
        })->avg();

        $d = [
            'comment:first' => OverallOrganisationEnablerMetrics::getFirstComment(
                $technologyAvg, $workflowAvg, $name
            ),
            'comment:second' => OverallOrganisationEnablerMetrics::getSecondComment(
                $documentationAvg, $talentAvg, $workflowAvg, $name
            ),
            'enablers' => [
                'Workflow Processess' => OverallOrganisationEnablerMetrics::getWorkflowProcessComment(
                    $workflowAvg, $name
                ),
                'Talent' => OverallOrganisationEnablerMetrics::getTalentComment($talentAvg),
                'Documentation' => OverallOrganisationEnablerMetrics::getDocumentationComment($documentationAvg),
                'Technology' => OverallOrganisationEnablerMetrics::getTechnologyComment(
                    $technologyAvg, $name
                ),
            ],

            'chart' => [
                'label' => [ __('Workflow Processess'), __('Talent'), __('Documentation'), __('Technology')],
                'data' => [$workflowAvg*100, $talentAvg*100, $documentationAvg*100, $technologyAvg*100],
            ],
        ];

        return $d;
    }

    /**
     * Retrieve the orig ave.
     *
     * @param  array $indices
     * @return array
     */
    public function getOriginalAverage($indices)
    {
        $indices = collect($indices)->filter(function ($i) {
            return $i['has:reports'];
        })->map(function ($i) {
            return $i['key:enablers']['data'];
        });

        $documentationAvg = round($indices->map(function ($i) {
            return $i['Documentation']['value']/100;
        })->avg() * 100);

        $talentAvg = round($indices->map(function ($i) {
            return $i['Talent']['value']/100;
        })->avg() * 100);

        $technologyAvg = round($indices->map(function ($i) {
            return $i['Technology']['value']/100;
        })->avg() * 100);

        $workflowAvg = round($indices->map(function ($i) {
            return $i['Workflow Processes']['value']/100;
        })->avg() * 100);

        return [
            'label' => ['Documentation', 'Talent', 'Technology', 'Workflow Processes'],
            'data' => [$documentationAvg, $talentAvg, $technologyAvg, $workflowAvg],
            'keyed:data' => [
                'Documentation' => $documentationAvg,
                'Talent' => $talentAvg,
                'Technology' => $technologyAvg,
                'Workflow Processes' => $workflowAvg,
            ]
        ];
    }

    /**
     * Retrieve the Financial Analysis data.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getFinancialAnalysisData(Customer $customer)
    {
        return [
            'profitability' => ProfitabilityAnalysis::getReport($customer),
            'liquidity' => LiquidityAnalysis::getReport($customer),
            'efficiency' => EfficiencyAnalysis::getReport($customer),
            'solvency' => SolvencyAnalysis::getReport($customer),
            'productivity' => ProductivityAnalysis::getReport($customer),
        ];
    }

    /**
     * Retrieve the Financial Ratios array.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getFinancialRatios(Customer $customer)
    {
        return FinancialRatios::getReport($customer);
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
                'comments' => (array) $list,
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
            return ($submission->submissible->metadata['category']['Documentation'] ?? false)
                && $submission->submissible->metadata['category']['Documentation'] == 'Y';
        })->reject(function ($submission) {
            return (float) $submission->metadata['average'] == 0.00;
        });

        $talent = $reports->map(function ($report) {
            return $report->reportable;
        })->filter(function ($submission) {
            return ($submission->submissible->metadata['category']['Talent'] ?? false)
                && $submission->submissible->metadata['category']['Talent'] == 'Y';
        })->reject(function ($submission) {
            return (float) $submission->metadata['average'] == 0.00;
        });

        $technology = $reports->map(function ($report) {
            return $report->reportable;
        })->filter(function ($submission) {
            return ($submission->submissible->metadata['category']['Technology'] ?? false)
                && $submission->submissible->metadata['category']['Technology'] == 'Y';
        })->reject(function ($submission) {
            return (float) $submission->metadata['average'] == 0.00;
        });

        $workflow = $reports->map(function ($report) {
            return $report->reportable;
        })->filter(function ($submission) {
            return ($submission->submissible->metadata['category']['Workflow Processes'] ?? false)
                && $submission->submissible->metadata['category']['Workflow Processes'] == 'Y';
        })->reject(function ($submission) {
            return (float) $submission->metadata['average'] == 0.00;
        });

        $docScoreValue = config("modules.best.scores.key_enablers_score.{$code}.Documentation");
        $documentationValue = round((
            ($documentation->sum('results')/($documentation->count() ?: 1))/$docScoreValue
        ) * 100);

        $talentScoreValue = config("modules.best.scores.key_enablers_score.{$code}.Talent");
        $talentValue = round((
            ($talent->sum('results')/($talent->count() ?: 1))/$talentScoreValue
        ) * 100);

        $technologyScoreValue = config("modules.best.scores.key_enablers_score.{$code}.Technology");
        $technologyValue = round((
            ($technology->sum('results')/($technology->count() ?: 1))/$technologyScoreValue
        ) * 100);

        $workflowScoreValue = config("modules.best.scores.key_enablers_score.{$code}.Workflow Processes");
        $workflowValue = round((
            ($workflow->sum('results')/($workflow->count() ?: 1))/$workflowScoreValue
        ) * 100);

        $documentationComment = '';
        $documentationSubscore = $documentation->sortBy('metadata.subscore')->take(3)->values();
        if (($documentationValue/100) > config('modules.best.scores.grades.red')) {
            if (($documentationValue/100) > config('modules.best.scores.grades.amber')) {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? 'greaterThan90' : '50to90';
                $documentationComment = trans("best::enablers/$code.documentation.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($documentationSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($documentationSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($documentationSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? '50to90' : '30to50';
                $documentationComment = trans("best::enablers/$code.documentation.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($documentationSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($documentationSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($documentationSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        } else {
            if (($documentationValue/100) < config('modules.best.scores.grades.nonlight')) {
                $documentationComment = trans("best::enablers/$code.documentation.less30", [
                    'name' => $customer ?? null,
                    'item1' => __($documentationSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($documentationSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($documentationSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $documentationComment = trans("best::enablers/$code.documentation.30to50", [
                    'name' => $customer ?? null,
                    'item1' => __($documentationSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($documentationSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($documentationSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        }//end if

        $talentComment = '';
        $talentSubscore = $talent->sortBy('metadata.subscore')->take(3)->values();
        if (($talentValue/100) > config('modules.best.scores.grades.red')) {
            if (($talentValue/100) > config('modules.best.scores.grades.amber')) {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? 'greaterThan90' : '50to90';
                $talentComment = trans("best::enablers/$code.talent.$commentValue", [
                    'name' => $customer,
                    'item1' => __($talentSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($talentSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($talentSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? '50to90' : '30to50';
                $talentComment = trans("best::enablers/$code.talent.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($talentSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($talentSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($talentSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        } else {
            if (($talentValue/100) < config('modules.best.scores.grades.nonlight')) {
                $talentComment = trans("best::enablers/$code.talent.less30", [
                    'name' => $customer,
                    'item1' => __($talentSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($talentSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($talentSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $talentComment = trans("best::enablers/$code.talent.30to50", [
                    'name' => $customer ?? null,
                    'item1' => __($talentSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($talentSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($talentSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        }//end if

        $technologyComment = '';
        $technologySubscore = $technology->sortBy('metadata.subscore')->take(3)->values();
        if (($technologyValue/100) > config('modules.best.scores.grades.red')) {
            if (($technologyValue/100) > config('modules.best.scores.grades.amber')) {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? 'greaterThan90' : '50to90';
                $technologyComment = trans("best::enablers/$code.technology.$commentValue", [
                    'name' => $customer,
                    'item1' => __($technologySubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($technologySubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($technologySubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? '50to90' : '30to50';
                $technologyComment = trans("best::enablers/$code.technology.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($technologySubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($technologySubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($technologySubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        } else {
            if (($technologyValue/100) < config('modules.best.scores.grades.nonlight')) {
                $technologyComment = trans("best::enablers/$code.technology.less30", [
                    'name' => $customer ?? null,
                    'item1' => __($technologySubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($technologySubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($technologySubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $technologyComment = trans("best::enablers/$code.technology.30to50", [
                    'name' => $customer ?? null,
                    'item1' => __($technologySubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($technologySubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($technologySubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        }//end if

        $workflowComment = '';
        $workflowSubscore = $workflow->sortBy('metadata.subscore')->take(3)->values();
        if (($workflowValue/100) > config('modules.best.scores.grades.red')) {
            if (($workflowValue/100) > config('modules.best.scores.grades.amber')) {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? 'greaterThan90' : '50to90';
                $workflowComment = trans("best::enablers/$code.workflow.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($workflowSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($workflowSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($workflowSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? '50to90' : '30to50';
                $workflowComment = trans("best::enablers/$code.workflow.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($workflowSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($workflowSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($workflowSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        } else {
            if (($workflowValue/100) < config('modules.best.scores.grades.nonlight')) {
                $workflowComment = trans("best::enablers/$code.workflow.less30", [
                    'name' => $customer ?? null,
                    'item1' => __($workflowSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($workflowSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($workflowSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $workflowComment = trans("best::enablers/$code.workflow.30to50", [
                    'name' => $customer ?? null,
                    'item1' => __($workflowSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($workflowSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($workflowSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        }//end if

        return [
            'chart' => [
                'labels' => [__('Documentation'), __('Talent'), __('Technology'), __('Workflow Processes')],
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
     * Retrieve the key enablers description.
     *
     * @param  string $code
     * @return string
     */
    public function getKeyEnablersDescription($code)
    {
        $code = strtolower($code);
        $comment = '';

        switch ($code) {
            case 'fmpi':
                $comment = trans("best::enablers/fmpi.description");
                break;

            case 'bspi':
                $comment = trans("best::enablers/bspi.description");
                break;

            case 'hrpi':
                $comment = trans("best::enablers/hrpi.description");
                break;

            case 'pmpi':
                $comment = trans("best::enablers/pmpi.description");
                break;
        }

        return $comment;
    }

    /**
     * Retrieve the box comments.
     *
     * @param  Illuminate\Support\Collection $group
     * @param  string                        $code
     * @return string|array
     */
    public function getFirstBoxComment($group, $code)
    {
        $code = strtolower($code);

        $firstSentence = [];

        if ($group->avg() >= 1) {
            $firstSentence[] =  trans("best::comments.{$code}.100");
        } else {
            // Last element.
            $fifthElement = $group->sortByDesc(function ($item) {
                return $item;
            })->keys()->get(0);
            // Second to the last.
            $fourthElement = $group->sortByDesc(function ($item) {
                return $item;
            })->keys()->get(1);

            if ($group->sort()->get($fifthElement) == $group->sort()->get($fourthElement)) {
                $firstSentence[] = trans("best::comments.{$code}.first.based on responses", [
                    'item1' => __($fifthElement), 'item2' => __($fourthElement)
                ]);
            } else {
                $firstSentence[] = trans("best::comments.{$code}.first.most well implemented", [
                    'item1' => __($fifthElement)
                ]);
            }

            if ($group->sort()->get($fifthElement) == $group->sort()->get($fourthElement)) {
                $firstSentence[] = '';
            } else {
                $firstSentence[] = trans("best::comments.{$code}.first.followed by", [
                    'name' => __($fourthElement), 'score' => round(($group->sort()->get($fourthElement)*100)).'%'
                ]);
                $firstSentence[] = trans("best::comments.{$code}.first.it is imperative");
            }
        }//end if

        return $firstSentence;
    }

    /**
     * Retrieve the box comments.
     *
     * @param  Illuminate\Support\Collection $group
     * @param  string                        $code
     * @return string|array
     */
    public function getSecondBoxComment($group, $code)
    {
        $code = strtolower($code);
        $firstElement = $group->sort()->keys()->get(0);
        $secondElement = $group->sort()->keys()->get(1);

        return trans("best::comments.{$code}.second", [
            'item1' => __($firstElement),
            'item2' => __($secondElement),
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
            'labels' => $group->keys()->map(function ($item) {
                return __($item);
            }),
            'data' => $group->values()->map(function ($i) {
                return $i*100;
            }),
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
        return round(($score/$total)*100, 2);
    }

    /**
     * Retrieve the overall comment.
     *
     * @param  string $code
     * @param  string $customer
     * @param  float  $total
     * @return mixed
     */
    public function getOverallFindingsCommentOverall($code, $customer, $total)
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

    /**
     * Retrieve the overall comment.
     *
     * @param  string $code
     * @param  string $customer
     * @param  float  $total
     * @return mixed
     */
    public function getOverallFindingsComment($code, $customer, $total)
    {
        switch ($code) {
            case 'BSPI':
            case 'HRPI':
            case 'PMPI':
                $total = ($total - 0.5) * 2.3;
                break;

            default:
                $total = $total;
                break;
        }

        $total = $total/100;
        $comment = null;
        $code = strtolower($code);

        if ($total > config('modules.best.scores.grades.red')) {
            if ($total > config('modules.best.scores.grades.amber')) {
                $comment = trans("best::overall.{$code}.above90", ['name' => $customer, 'appcode' => 'asfsdf']);
            } else {
                $comment = trans("best::overall.{$code}.mid50to89", ['name' => $customer, 'appcode' => 'asfsdf']);
            }
        } else {
            $comment = trans("best::overall.{$code}.below50", ['name' => $customer, 'appcode' => 'asfsdf']);
        }

        return $comment;
    }
}