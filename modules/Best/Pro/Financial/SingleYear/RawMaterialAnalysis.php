<?php

namespace Best\Pro\Financial\SingleYear;

class RawMaterialAnalysis
{
    public static function getReport($financialStatements)
    {
        $projectType = $financialStatements[0]['metadataResults']['ratioAnalysis']['dashboard']['project_type'];
        $score = round($financialStatements[0]['metadataResults']['ratioAnalysis']['additional_ratios']['raw_materials_margin'] * 100, 2); 
        $goodScore = self::getBenchMarkScore($projectType);

        $labels = [
           'preview' => [__("Raw Materials Margin ({$score}%)"), __("Recommended Good Score ({$goodScore}%)")],
           'pdf' => ["{$score}%", "{$goodScore}%"],
        ];
        
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

        $marginRatio = ['raw_materials_margin'];

        foreach ($financialStatements as $statement) {

            $tempData = [];

            $projectType = $statement['metadataResults']['ratioAnalysis']['dashboard']['project_type'];
            $profitability = $statement['metadataResults']['ratioAnalysis']['additional_ratios'];

            foreach ($marginRatio as $item) {
                $value = $item == 'operating_ratio' ? (float) str_replace(':1', "", $profitability[$item]): (float) $profitability[$item];

                $tempData[] = round($value * 100, 2);
            }

            $data[$statement['period']] = $tempData;
        }

        return self::dataSet($data, $projectType);
    }

    protected static function getComment($financialStatements)
    {
        $projectType = $financialStatements['metadataResults']['ratioAnalysis']['dashboard']['project_type']; 
        $remarks = $financialStatements['metadataResults']['ratioAnalysis']['dashboard']['raw_materials']['remarks'];

        $comments = [
            'Very Poor' => "Critical consideration to review existing suppliers and partners, widen the group of suppliers available and/or negotiate for a significant reduction in costs to ensure a healthy and sustainable business operations.",
            'Poor' => 'Strengthen partnership with existing supply partners to gain better price and improved margin.',
            'Moderate' => 'While margin remains within modest levels, volatility in pricing due to external factors calls for a more cautious approach and risk diversification.',
            'Good' => 'Positive margins could help in finding appropriatemale partner for further explansion.',
            'Excellent' => 'Retain existing suppliers while continuing to monitor and reduce direct costs further optimising profits levels.'
        ];

        
        return "{$remarks} Raw Materials Margin by {$projectType} standards. ".$comments[$remarks];

    }

    protected static function dataSet($data, $projectType)
    {
        $dataSet = [];

        $count = 0;

        foreach ($data as $period => $datum) {

            $isMostRecent = count($data) == ($count + 1) ? ' (most recent)' : '';

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
            'industrial' => 35,
            'non-industrial' => 25,
        ];

        return $benchMarks[strtolower($projectType)];
    }
}