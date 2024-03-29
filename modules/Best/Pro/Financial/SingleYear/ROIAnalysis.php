<?php

namespace Best\Pro\Financial\SingleYear;

class ROIAnalysis
{
    public static function getReport($financialStatements)
    {
        $projectType = strtolower(
            str_replace(
            ' ',
            '-',
            $financialStatements[0]['metadataResults']['ratioAnalysis']['dashboard']['project_type'])
        );

        $score = round($financialStatements[0]['metadataResults']['ratioAnalysis']['additional_ratios']['roi'], 2);
        $goodScore = self::getBenchMarkScore($projectType);
        $year = $financialStatements[0]['period'];

        $labels = [
           'preview' => [["{$year}", "{$score}"], [__("Recommended"), "{$goodScore}"]],
           'pdf' => [["{$year}", "{$score}"], [__("Recommended"), "{$goodScore}"]],
        ];

        return [
            'chart' => [
                'labels' => $labels,
                'dataset' => self::formatDataSet($financialStatements, $projectType),
            ],
            'comment' => [
                self::getComment($financialStatements[0]),
            ],
        ];
    }

    protected static function formatDataSet($financialStatements, $projectType)
    {
        $data = [];

        $marginRatio = ['roi'];

        foreach ($financialStatements as $statement) {

            $tempData = [];

            $profitability = $statement['metadataResults']['ratioAnalysis']['additional_ratios'];

            foreach ($marginRatio as $item) {
                $value = $item == 'operating_ratio' ? (float) str_replace(':1', "", $profitability[$item]): (float) $profitability[$item];

                $tempData[] = round($value, 2);
            }

            $data[$statement['period']] = $tempData;
        }

        return self::dataSet($data, $projectType);
    }

    protected static function getComment($financialStatements)
    {
        $projectType = str_replace(
            ' ',
            '-',
            $financialStatements['metadataResults']['ratioAnalysis']['dashboard']['project_type']
        );

        $remarks = $financialStatements['metadataResults']['ratioAnalysis']['dashboard']['roi']['remarks'];

        $comments = [
            'Very Poor' => "Business should review the key purpose of the investment and explore alternative strategies to mitigate and revive the gains from the investment",
            'Poor' => 'Revist the business plan to review prior sales estimates and marketing drivers',
            'Moderate' => 'A review of business strategy is recommended to explore operational improvements and technology adoption into business operations',
            'Good' => 'Healthy investment likely to lead better future for business',
            'Excellent' => 'Firm position to continue expansionary strategies'
        ];

        return __("{$remarks} ROI by {$projectType} standards"). '. ' . __($comments[$remarks]);
    }

    protected static function dataSet($data, $projectType)
    {
        $dataSet = [];

        $count = 0;

        foreach ($data as $period => $datum) {

            $isMostRecent = count($data) == ($count + 1) ? '(' . __('most recent') . ')' : '';

            $year = "{$period}{$isMostRecent}";

            $dataNumber = [
                $data[$period][0],
                self::getBenchMarkScore($projectType)
            ];

            $dataSet[] = [
                'label' => $year,
                'data' => $dataNumber,
                'backgroundColor' => ['#a2d5ac', '#468086'],
                'borderColor' => ['#a2d5ac', '#468086'],
            ];

            $count++;
        }

        return $dataSet;
    }


    protected static function getBenchMarkScore($projectType)
    {
        $benchMarks = [
            'industrial' => 0.1,
            'non-industrial' => 0.15,
        ];

        return $benchMarks[strtolower($projectType)];
    }
}
