<?php

namespace Best\Pro;
use Illuminate\Support\Str;
use Best\Pro\PredictionScoreCard;

abstract class KeyStrategicRecommendationComments
{
    /**
     * Retrieve comment via keyword.
     *
     * @param  string $keyword
     * @param  string $index
     * @return string
     */
    public static function get($keyword, $index)
    {
        $keyword = self::parseKeyword($keyword);

        if (! method_exists(KeyStrategicRecommendationComments::class, "{$index}Recommendations")) {
            return [];
        }

        $list = call_user_func_array(
            [KeyStrategicRecommendationComments::class, "{$index}Recommendations"], []
        );

        $list = collect($list)->filter(function ($item) use ($keyword) {
            return $keyword == key((array) $item);
        })->flatten();

        if ($list->isEmpty()) {
            return self::getEmptyComment($keyword);
        }

        return $list->toArray();
    }

    /**
    * Retrive comment via subscore
    * @author Louie Angelo Daliwan
    * @param object fields
    * @param string index
    * @return array
    */
    public static function getSolution($enablers, $index, $fields)
    {
        $list = self::solutionRecommendations($index);

        $temp_categories_recom = [
            'Documentation' => ['Empty' => self::getEmptyComment('Documentation')],
            'Talent' => ['Empty' => self::getEmptyComment('Talent')],
            'Technology' => ['Empty' => self::getEmptyComment('Technology')],
            'Workflow Processes' => ['Empty' => self::getEmptyComment('Workflow Processes')],
        ];

        $count = 1;

        /*
        * @return array PredictionScoreCard::get()
        */
        foreach(PredictionScoreCard::get($fields, $index) as $score){

            if(!isset($list[$score])){continue;}

            $reco = $list[$score];

            $keyword = self::parseKeyword(key($reco));

            if(array_key_exists('Empty', $temp_categories_recom[$keyword])){
                unset($temp_categories_recom[$keyword]['Empty']);
            }

            if(!empty($temp_categories_recom[$keyword])){
                in_array(array_values($reco)[0], $temp_categories_recom[$keyword]) ? : $temp_categories_recom[$keyword][] = array_values($reco)[0];
            } else {
                $temp_categories_recom[$keyword][] = array_values($reco)[0];
            }

            $count++;

            if($count == config('ksrecommendation.' . $index . '.count')) {break;}
        }

        return self::organizeRecommendation($temp_categories_recom);
    }

    /**
     * List of strategic recommendations.
     *
     * @return array
     */
    public static function fmpiRecommendations()
    {
        return [
            ['Personnel' => 'Develop competency capabilities within finance team'],
            ['Personnel' => 'Equip HODs with relevant financial management literacy'],
            ['Documentation' => 'Review relevant financial indicators'],
            ['Process' => 'Systemise financial analysis report for management'],
            ['Process' => 'Conduct periodic risk assessments'],
            ['Documentation' => 'Review templates & forms for financial projections'],
            ['Personnel' => 'Empower and equip appropriate staff to oversee financial management'],
            ['Personnel' => 'Segregate key financial roles to relevant representatives in the organisation'],
            ['Personnel' => 'Conduct inventory management training'],
            ['Process' => 'Conduct comprehensive 3rd party due diligence'],
            ['Empty' => 'Review scope of financial management report'],
        ];
    }

    /**
     * List of strategic recommendations.
     *
     * @return array
     */
    public static function solutionRecommendations($index)
    {
        return config('ksrecommendation.'. $index .'.list');
    }

    /**
     * List of strategic recommendations.
     *
     * @return array
     */
    public static function hrpiRecommendations()
    {
        return [
            ['Documentation' => 'Develop JD Framework'],
            ['Personnel' => 'Create learning & development culture'],
            ['Documentation' => 'Review manpower regulations & policies'],
            ['Process' => 'Evaluate & Refine Employee Engagement & Communication Strategies'],
            ['Technology' => 'Ease access to Compensation & Benefits information'],
            ['Documentation' => 'Regular Manual Updates'],
            ['Process' => 'Implement Leadership Development Programme for High Performers'],
            ['Process' => 'Review performance communication strategies'],
            ['Empty' => 'Align company goals with performance objectives'],
            ['Empty' => 'Succession Management'],
        ];
    }

    /**
     * List of strategic recommendations.
     *
     * @return array
     */
    public static function bspiRecommendations()
    {
        return [
            ['Personnel' => 'Attend Business Continuity Management training'],
            ['Personnel' => 'Conduct skills upgrading to familiarise with adopted technology'],
            ['Process' => 'Conduct gap review of existing risk management strategies'],
            ['Documentation' => 'Set-up Strategic Management framework'],
            ['Process' => 'Review integration of communication tools across work functions'],
            ['Technology' => "Review & align effectiveness of collaborative tools' purposes"],
            ['Technology' => 'Implement collaborative tools for employee engagements'],
            ['Process' => 'Review technology procurement process'],
            ['Process' => 'Review Strategic Management framework'],
            ['Process' => 'Introduce appropriate periodic management communication sessions'],
            ['Empty' => 'Implement employee engagement strategies relating to organisation strategies & direction'],
            ['Empty' => 'Review employee engagement strategies'],
        ];
    }

    /**
     * List of strategic recommendations.
     *
     * @return array
     */
    public static function pmpiRecommendations()
    {
        return [
            ['Process' => 'Appoint or Conduct Market Research periodically'],
            ['Personnel' => 'Conduct a training Needs Analysis'],
            ['Process' => 'Review IMPACT Framework'],
            ['Process' => 'Ensure more stakeholder involvement during appropriate service development stages'],
            ['Process' => 'Introduce Plan, Do, Check, Act (PDCA) Process'],
            ['Technology' => 'Improve on the Employee Scheduling'],
            ['Documentation' => 'Adopt Fishbone Diagram tool in problem solving'],
        ];
    }

    /**
     * List of strategic recommendations.
     *
     * @return array
     */
    public static function otherRecommendations()
    {
        return [
            "No immediate 'Technology' intervention required in the short-term",
            "No immediate 'Documentation' intervention required in the short-term",
            "No immediate 'Talent' intervention required in the short-term",
            "No immediate 'Workflow Processes' intervention required in the short-term",
            "Overall Comments",
            "Client Signature",
            "Manager Signature",
            "Business Counselor Signature",
        ];
    }

    /**
     * Retrieve the empty comment.
     *
     * @param  string $name
     * @return string
     */
    public static function getEmptyComment($name)
    {
        return trans("No immediate '{$name}' intervention required in the short-term");
    }

    /**
     * Swap keywords.
     *
     * @param  string $keyword
     * @return string
     */
    public static function parseKeyword($keyword)
    {
        switch ($keyword) {
            case 'Personnel':
                $keyword = 'Talent';
                break;

            case 'Process':
                $keyword = 'Workflow Processes';
                break;

            case 'ICT':
                $keyword = 'Technology';
                break;

            default:
                $keyword = $keyword;
                break;
        }

        return $keyword;
    }

    //set the format recommendations in array
    protected static function organizeRecommendation($temp_categories_recom)
    {
        foreach($temp_categories_recom as $keyword => $data){
            $icon = Str::slug($keyword);
            $recommendations[$keyword] = [
                'comments' => (array) $data,
                'comment' => implode(' || ', (array) $data),
                'icon' => asset("reports/assets/icons/png/$icon.png"),
                'icon:path' => public_path("reports/assets/icons/png/$icon.png"),
            ];
        }

        return $recommendations;
    }
}
