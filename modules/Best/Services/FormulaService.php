<?php

namespace Best\Services;

use Carbon\Carbon;
use User\Models\User;
use Index\Models\Index;
use Best\Models\Formula;
use Best\Pro\KeyEnablers;
use Survey\Models\Survey;
use Best\Pro\TrafficLight;
use Illuminate\Support\Str;
use Setting\Models\Setting;
use Illuminate\Http\Request;
use Customer\Models\Customer;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Auth;
use Core\Application\Service\Service;
use Best\Pro\Financial\FinancialRatios;
use Customer\Models\FinancialStatement;
use Best\Pro\Financial\SolvencyAnalysis;
use Best\Pro\Financial\LiquidityAnalysis;
use Best\Pro\Financial\EfficiencyAnalysis;
use Best\Pro\Financial\ProductivityAnalysis;
use Best\Pro\Financial\ProfitabilityAnalysis;
use Best\Pro\Financial\ProductivityIndicators;
use Best\Pro\KeyStrategicRecommendationComments;
use Best\Pro\Enablers\OverallOrganisationEnablerMetrics;
use Best\Pro\Financial\SingleYear\CurrentRatioAnalysis;
use Best\Pro\Financial\SingleYear\DebtRatioAnalysis;
use Best\Pro\Financial\SingleYear\GrossMarginAnalysis;
use Best\Pro\Financial\SingleYear\NetMarginAnalysis;
use Best\Pro\Financial\SingleYear\RawMaterialAnalysis;
use Best\Pro\Financial\SingleYear\ROIAnalysis;
use Customer\Models\Attributes\RatingGraph;
use Illuminate\Support\Facades\Cache;

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
    public function generate(Survey $survey, array $attributes, $taxonomy_name = null)
    {
        $customer = Customer::find($attributes['customer_id']);
        $taxonomies = Index::all();
        $user = $this->auth()->user();

        $monthkey = $attributes['monthkey'] ?? date('m-Y', strtotime($attributes['month']));

        // Retrieve the Customer array.
        $this->data['organisation:profile'] = $customer->toArray();
        $this->data['survey:id'] = $survey->getKey();
        $this->data['user:id'] = $user->getKey();
        $this->data['month'] = $attributes['month'] ?? date('m-Y');
        $this->data['monthkey'] = $monthkey;
        $this->data['month:formatted'] = date('M Y', strtotime($attributes['month'] ?? date('M Y')));
        $this->data['overall:user:comment'] = Setting::whereUserId($user->getKey())
            ->whereKey("overall:comment/".$customer->getKey().$monthkey)
            ->first()->value ?? null;


        $financialStatements = FinancialStatement::where('customer_id', $customer->id)
        ->orderBy('period', 'desc')
        ->take(3)
        ->get()
        ->sortBy('period')
        ->toArray();

        // Retrieve Performance Indices data.
        foreach ($taxonomies as $i => $taxonomy) {
            
            if($taxonomy->alias == 'SDMI') {
                continue;
            }

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
            )->where(
                'monthkey',
                $monthkey
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
                'elements' => $group = $this->getGroupedAverage($taxonomy->alias),
                'elements:charts' => $this->getChartedGroupedAverage($group),
                'cover:date' => date(settings('formal:date', 'Y-m-d')),
                'cover:description' => $taxonomy->metadata['report:description'] ?? null,
                'customer:name' => $customer->name,
                'customer:refnum' => $customer->refnum,
                'customer:industry' => $customer->metadata['industry'] ?? null,
                'customer:counselor' => $customer->metadata['BusinessCounselorName'] ?? null,
                'customer:staffstrength' => $customer->metadata['staffstrength'] ?? null,
                'customer:type' => $customer->metadata['type'] ?? null,
                'subscore:score' => $totalSubscoreScore = $this->getTotalIndexSubscoreScore($survey, $attributes['customer_id'], $monthkey),
                'subscore:total' => $totalSubscoreTotal = $this->getTotalIndexSubscoreTotal($survey, $attributes['customer_id'], $monthkey),
                'overall:total' => $total = $this->getOverallTotalAverage($totalSubscoreScore, $totalSubscoreTotal, $taxonomy->alias, $attributes['customer_id']),
                $this->getIndexOverAllScoreKey($taxonomy) => $total,
                'overall:comment' => $this->getOverallFindingsComment($taxonomy->alias, $customer->name, $total),
                'overall:comment:overall' => $this->getOverallFindingsCommentOverall(
                    $taxonomy->alias, $customer->name, $total
                ),
                'box:comments' => [
                    $this->getFirstBoxComment($group, $taxonomy->alias),
                    $this->getSecondBoxComment($group, $taxonomy->alias),
                ],
                'key:enablers' => $enablers = $this->getKeyEnablers($this->reports, $customer->name, $taxonomy->alias),
                'key:enablers:description' => $this->getKeyEnablersDescription($taxonomy->alias, $attributes['month'], $survey->fields),
                'key:recommendations' => $this->getKeyStrategicRecommendations($enablers, $taxonomy->alias, $survey->fields, $attributes['month'], $customer->id, $user->id),
                'has:reports' => $this->reports->count(),
                'reports' => $this->reports,
                'report:user' => $user->displayname,
                'sitevisit:date' => $attributes['month'] ?? date('m-Y'),
                'sitevisit:date:formatted' => date('M Y', strtotime($attributes['month'] ?? date('M Y'))),
            ];
        }//end foreach

        // Retrieve Overall BEST Score.
        $this->data['overall:score'] = $overallScore = $this->getOverallScore($this->data['indices'], $customer, $monthkey);
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
        $this->data['analysis:financial'] = $this->getFinancialAnalysisData($customer, $financialStatements);

        // Retrieve the Financial Ratios and Productivity Indicators.
        $this->data['ratios:financial'] = $this->getFinancialRatios($customer, $financialStatements);
        $this->data['indicators:productivity'] = $this->getProductivityIndicators($customer, $financialStatements);

        // User object.
        $this->data['report:user'] = $user->displayname;
        $this->data['customer:type'] = $customer->metadata['type'] ?? null;

        $index = Index::find($attributes['taxonomy_id'] ?? false);
        
        if ($index && $index->alias != 'SDMI') {
            $this->data['current:index'] = $this->data['indices'][$index->alias];
            $this->data['current:pindex'] = $this->data['indices'][$index->alias];
        }
        
    

        $this->data['is_single'] = collect($financialStatements)->count() < 2 ? true : false;
        $this->data['financialStatementCount'] = collect($financialStatements)->count();

        return $this->data;
    }

    /**
     * Retrieve the overall report score.
     *
     * @param  array $indices
     * @return string
     */
    public function getOverallScore($indices, $customer, $monthKey)
    {
        $user = auth()->user()->id;

        $keyName = "{$customer->id}-Overall-{$user}";
        $sdmiName = "{$customer->id}-SDMI-{$user}";

        if( cache($keyName)) {
            Cache::forget($keyName);
        }

        if( cache($sdmiName)) {
            Cache::forget($sdmiName);
        }
      
        $collect = collect($indices);

        $ratingGraph = RatingGraph::getRatings($customer);
        
        $financialScore = ($ratingGraph['smeRatings'][5]['score'] / 5) * 0.3;
        
        $sdmiIndex = $customer->sdmiComputation()->where('month_key', $monthKey)->first();

        $sdmiScore = round(($sdmiIndex->metadata['index'] * 0.2), 2);

        Cache::forever($sdmiName, $sdmiScore);
        
        $exists_section_score_zero = $collect->map(function ($index) {
            return $index['subscore:score'] == 0;
        })->contains(true);

        if ($exists_section_score_zero) {
            Cache::forget($keyName);
            return 0;
        }

        $totalOf4Index = round($collect->map(function ($index) {

            if ($index['subscore:score'] == 0) {
                return 0 * $index['pindex:weightage'];
            }

            $avg = $index['subscore:total'] != 0 ? $index['subscore:score']/$index['subscore:total'] : 0;
            return $avg*$index['pindex:weightage'];

        })->sum(), 2);
        
        $results = round(($totalOf4Index + $financialScore + $sdmiScore), 2);
         
        return Cache::forever($keyName, $results);
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
     * @param  \Customer\Models\FinancialStatement $financialStatements;
     * @return array
     */
    public function getFinancialAnalysisData(Customer $customer, $financialStatements)
    {
        if (collect($financialStatements)->count() == 1) {
                return [
                    'gross_ratio' => GrossMarginAnalysis::getReport($financialStatements),
                    'net_margin' => NetMarginAnalysis::getReport($financialStatements),
                    'current_ratio' => CurrentRatioAnalysis::getReport($financialStatements),
                    'debt_ratio' => DebtRatioAnalysis::getReport($financialStatements),
                    'roi' => ROIAnalysis::getReport($financialStatements),
                    'raw_materials' => RawMaterialAnalysis::getReport($financialStatements),
                ];                       
        } else {
            return [
                'profitability' => ProfitabilityAnalysis::getReport($financialStatements),
                'liquidity' => LiquidityAnalysis::getReport($financialStatements, $customer),
                'efficiency' => EfficiencyAnalysis::getReport($financialStatements, $customer),
                'solvency' => SolvencyAnalysis::getReport($financialStatements, $customer),
                'productivity' => ProductivityAnalysis::getReport($financialStatements, $customer),
            ];

        }
        
    }

    /**
     * Retrieve the Financial Ratios array.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getFinancialRatios(Customer $customer, $financialStatements)
    {
        return FinancialRatios::getReport($customer, $financialStatements);
    }

    /**
     * Retrieve the productivity indicators.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getProductivityIndicators($customer, $financialStatements)
    {
        return ProductivityIndicators::getReportWithCustomer($customer, $financialStatements);
    }

    /**
     * Retrieve the recommendation comments.
     *
     * @param  array  $enablers
     * @param  string $index
     * @param object $month
     * @return array
     */
    public function getKeyStrategicRecommendations($enablers, $index, $fields, $month, $customerId, $userId)
    {
        $index = strtolower($index);

        return  KeyStrategicRecommendationComments::getSolution($enablers, $index, $fields, $month, $customerId, $userId);

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
       return KeyEnablers::get($reports, $customer, $code);
    }

    /**
     * Retrieve the key enablers description.
     *
     * @param  string $code
     * @return string
     */
    public function getKeyEnablersDescription($code, $month, $fields)
    {
        return KeyEnablers::getDescription($code, $month, $fields);
    }


     /*
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
        } else if( $group->avg() >= .6 ) {
            $fifthElement = $group->sortByDesc(function ($item) {
                return $item;
            })->keys()->get(0);
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
        }

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

        $secondSentence = [];

        $firstElement = $group->sort()->keys()->get(0);
        $secondElement = $group->sort()->keys()->get(1);

        if( $group->sort()->get($firstElement) < .6 ) {
            if($group->sort()->get($secondElement)  < .6 ) {
                $secondSentence[] = trans("best::comments.{$code}.second", [
                    'item1' => __($firstElement),
                    'item2' => __($secondElement),
                ]);
            } else {
                $secondSentence[] = trans("best::comments.{$code}.lowest", [
                    'item1' => __($firstElement)
                ]);
            }
        }

        return $secondSentence;
    }

    /**
     * Retrieve the collected grouped average.
     *
     * @return mixed
     */
    public function getGroupedAverage($alias)
    {

        //initiate collection
        $collect = collect([]);

        //will plot the phase 1 code
        //wll optimize this
        //author Louie Daliwan
        foreach ($this->reports->groupBy('group') as $category => $items) {

            $total_items = $this->categoryItemsCount($alias, $category);

            $temp_collect = collect([]);

            $count = 0;

            foreach ($items->sortByDesc('created_at') as $item) {
                if ($count != $total_items) {
                    if ($item->value != 0) {
                        $temp_collect->push($item->value);
                    }
                } else {
                    continue;
                }
                $count ++;
            }

            //check if the temporary collection is empty if yes the category is set to 0 unless get the avg of collected values
            $result = $temp_collect->isEmpty() ? 0 : round($temp_collect->avg(), 2);

            //put on the collection the category and result of computation
            $collect->put($category, $result);

        }

        return $collect;

        //will comment this
        // return $this->reports->groupBy('group')->map(function ($g) {
        //     return round($g->avg('value'), 2);
        // });
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
     * @param  int                  $customer_id
     * @param  String               $monthkey
     * @return string
     */
    public function getTotalIndexSubscoreScore(Survey $survey, int $customer_id, String $monthkey)
    {
        //will  optimize this
        //author Louie Daliwan
        $subscore = collect([]);

        foreach ($survey->fields as $field){
            if(isset($field->submissionBy($this->auth()->user(), $customer_id, $field->id, $monthkey)->metadata)) {
                if($field->submissionBy($this->auth()->user(), $customer_id, $field->id, $monthkey)->metadata['subscore'] != 0) {
                    $subscore->push($field->submissionBy($this->auth()->user(), $customer_id, $field->id, $monthkey)->metadata['subscore']);
                }
            }
        }

        return $subscore->sum();


        //old code
        // return $survey->fields->map(function ($field) use ($customer_id, $monthkey) {
        //     return $field->submissionBy($this->auth()->user(), $customer_id, $field->id, $monthkey)->metadata['subscore'] ?? 0;
        // })->sum();
    }

    /**
     * Get the total subscore of the survey.
     *
     * @param  Survey\Models\Survey $survey
     * @return string
     */
    public function getTotalIndexSubscoreTotal(Survey $survey, $customer_id, $monthkey)
    {

        //will  optimize this
        // author Louie Daliwan
        $subscore = collect([]);

        foreach ($survey->fields as $field){
            if(isset($field->submissionBy($this->auth()->user(), $customer_id, $field->id, $monthkey)->metadata)) {
                if($field->submissionBy($this->auth()->user(), $customer_id, $field->id, $monthkey)->metadata['subscore'] != 0) {
                    $subscore->push($field->metadata['total'] ?? 0);
                }
            }
        }
        return $subscore->sum();


        //old code
        // return $survey->fields->map(function ($field) {
        //     return $field->metadata['total'] ?? 0;
        // })->sum() ?: 1;
    }

    /**
     * Retrieve the index overall score key.
     *
     * @param  \Taxonomy\Models\Taxonomy $index
     * @return string
     */
    public function getIndexOverAllScoreKey($taxonomy)
    {
        $code = 'OverallScore';

        switch ($taxonomy->alias) {
            case 'FMPI':
                $code = 'Financial'.$code;
                break;

            case 'PMPI':
                $code = 'Productivity'.$code;
                break;

            case 'HRPI':
                $code = 'HR'.$code;
                break;

            case 'BSPI':
                $code = 'Sustainability'.$code;
                break;
        }

        return $code;
    }

    /**
     * Retrieve the group's average total.
     *
     * @param  integer $score
     * @param  integer $total
     * @return mixed
     */
    public function getOverallTotalAverage($score, $total, $taxonomy, $customerId)
    {
        $results = $score == 0 ? 0 :round(($score/$total)*100, 2);

        $user = auth()->user()->id;
        $keyName = "{$customerId}-{$taxonomy}-{$user}";

        if( cache($keyName)) {
            Cache::forget($keyName);
        }
        
        Cache::forever($keyName, $results);

        return $results;
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

    protected function categoryItemsCount($alias, $index)
    {
        $list = [
            'FMPI' => [
                'Cost Management' => 2,
                'Financial Analysis' => 3,
                'Financial Controls' => 3,
                'Forecasting & Budgeting' => 4,
                'Financial Risk Management' => 2,
            ],
            'BSPI' => [
                'Leadership' => 3,
                'Risk Management' => 4,
                'Organisational Management' => 4,
                'Organisational Culture' => 3,
            ],
            'PMPI' => [
                'Policies & Procedures' => 3,
                'Quality Management' => 6,
                'Technology & Tools' => 3,
                'Customer Experience' => 3,
                'Business Competitiveness' => 2,
            ],
            'HRPI' => [
                'Manpower Planning' => 2,
                'Recruitment & Selection' => 2,
                'Compensation & Benefits' => 2,
                'Performance Management' => 2,
                'Learning & Development' => 2,
                'Career & Talent Management' => 2,
                'Employee Engagement & Communication' => 2,
            ]
        ];

        return $list[$alias][$index];
    }
}
