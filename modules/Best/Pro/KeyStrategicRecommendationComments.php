<?php

namespace Best\Pro;

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
     * List of strategic recommendations.
     *
     * @return array
     */
    public static function fmpiRecommendations()
    {
        return [
            ['Documentation' => 'Review relevant financial indicators'],
            ['Process' => 'Review financial operational processes to maintain relevance'],
            ['Personnel' => 'Equip HODs with relevant financial management literacy'],
            ['Personnel' => 'Segregate key financial roles to relevant representatives in the organisation'],
            ['Documentation' => 'Review templates & forms for financial projections'],
            ['Documentation' => 'Review scope of financial management report'],
            ['Process' => 'Review effectiveness of inventory management practices'],
            ['Personnel' => 'Empower and equip appropriate staff to oversee financial management'],
            ['Empty' => 'Continue to maintain consistency and adherence to financial management practices'],
            ['Process' => 'Conduct periodic risk assessments'],
            ['Empty' => 'Conduct comprehensive 3rd party due diligence'],
        ];
    }

    /**
     * List of strategic recommendations.
     *
     * @return array
     */
    public static function hrpiRecommendations()
    {
        return [
            'Documentation' => 'Review manpower regulations & policies',
            'Process' => 'Evaluate & Refine Employee Engagement & Communication Strategies',
            'Documentation' => 'Develop JD Framework',
            'Personnel' => 'Create learning & development culture',
            'Personnel' => 'Succession Management',
            'Process' => 'Review performance communication strategies',
            'Documentation' => 'Regular Manual Updates',
            'Process' => 'Implement Leadership Development Programme for High Performers',
            'Empty' => 'Ease access to Compensation & Benefits information',
            'Empty' => 'Align company goals with performance objectives',
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
            'Personnel' => 'Conduct skills upgrading to familiarise with adopted technology',
            'Documentation' => 'Set-up Strategic Management framework',
            'Documentation' => 'Review work improvement schemes',
            'Process' => 'Review technology procurement process',
            'Process' => 'Review Strategic Management framework',
            'Process' => 'Review integration of communication tools across work functions',
            'ICT' => "Review & align effectiveness of collaborative tools' purposes",
            'Technology' => "Review & align effectiveness of collaborative tools' purposes",
            'Process' => 'Introduce appropriate periodic management communication sessions',
            'Process' => 'Implement employee engagement strategies relating to organisation strategies & direction',
            'Empty' => 'Implement collaborative tools for employee engagements',
            'Empty' => 'Conduct gap review of existing risk management strategies',
            'Empty' => 'Attend Business Continuity Management training',
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
            'Process' => 'Appoint or Conduct Market Research periodically',
            'Process' => 'Review IMPACT Framework',
            'Personnel' => 'Conduct a training Needs Analysis',
            'Process' => 'Introduce Plan, Do, Check, Act (PDCA) Process',
            'Process' => 'Ensure more stakeholder involvement during appropriate service development stages',
            'Documentation' => 'Adopt Fishbone Diagram tool in problem solving',
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
            case 'Talent':
                $keyword = 'Personnel';
                break;

            case 'Workflow Processes':
                $keyword = 'Process';
                break;

            default:
                $keyword = $keyword;
                break;
        }

        return $keyword;
    }
}
