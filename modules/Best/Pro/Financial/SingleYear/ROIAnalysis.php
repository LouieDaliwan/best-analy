<?php

namespace Best\Pro\Financial\SingleYear;

class ROIAnalysis
{
    public static function getReport($financialStatements)
    {

        $labels = ['ROI'];
        
        return [
            'chart' => [
                'labels' => $labels,
                'dataset' => self::formatDataSet($financialStatements),
            ],
            'comment' => [
                self::getComment($financialStatements[0]),
            ],
        ];
    }

    protected static function formatDataSet($financialStatements)
    {
        $data = [];

        $marginRatio = ['roi'];

        foreach ($financialStatements as $statement) {

            $tempData = [];

            $profitability = $statement['metadataResults']['ratioAnalysis']['additional_ratios'];

            foreach ($marginRatio as $item) {
                $value = $item == 'operating_ratio' ? (float) str_replace(':1', "", $profitability[$item]): (float) $profitability[$item];

                $tempData[] = round($value * 100, 2);
            }

            $data[$statement['period']] = $tempData;
        }

        return self::dataSet($data);
    }

    protected static function getComment($financialStatements)
    {
        $projectType = $financialStatements['metadataResults']['ratioAnalysis']['dashboard']['project_type']; 
        $remarks = $financialStatements['metadataResults']['ratioAnalysis']['dashboard']['roi']['remarks'];

        $comments = [
            'Very Poor' => "Business should review the key purpose of the investment and explore alternative strategies to mitigate and revive the gains from the investment.",
            'Poor' => 'Revist the business plan to review prior sales estimates and marketing drivers.',
            'Moderate' => 'A review of business strategy is recommended to explore operational improvements and technology adoption into business operations.',
            'Good' => 'Healthy investment likely to lead better future for business.',
            'Excellent' => 'Firm position to continue expansionary strategies.'
        ];

        
        return "{$remarks} ROI by {$projectType} standards. ".$comments[$remarks];
    }

    protected static function dataSet($data)
    {
        $dataSet = [];

        $color = ['#a2d5ac', '#3aada8', '#557c83'];

        $count = 0;

        foreach ($data as $period => $datum) {

            $bgColor = $color[$count];

            $isMostRecent = count($data) == ($count + 1) ? ' (most recent)' : '';

            $year = "{$period}{$isMostRecent}";

            $dataSet[] = [
                'label' => $year,
                'data' => $data[$period],
                'bg' => $bgColor,
                'backgroundColor' => [$bgColor, $bgColor],
            ];

            $count++;
        }

        return $dataSet;
    }
}