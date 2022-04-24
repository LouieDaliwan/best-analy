<?php

namespace Best\Pro\Financial\SingleYear;

class NetMarginAnalysis
{
    public static function getReport($financialStatements)
    {
        $projectType = $financialStatements[0]['metadataResults']['ratioAnalysis']['dashboard']['project_type']; 
        $score = round($financialStatements[0]['metadataResults']['ratioAnalysis']['profitability']['net_profit_margin'] * 100, 2);
        $goodScore = self::getBenchMarkScore($projectType);
        $labels = [
            'preview' => [__("Net Margin after Tax ({$score}%)"), __("Recommended Good Score ({$goodScore}%)")],
            'pdf' => ["{$score}%", "Recommended ({$goodScore}%)"],
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

        $marginRatio = ['net_profit_margin'];

        foreach ($financialStatements as $statement) {

            $tempData = [];
            $projectType = $statement['metadataResults']['ratioAnalysis']['dashboard']['project_type']; 
            $profitability = $statement['metadataResults']['ratioAnalysis']['profitability'];

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
        $remarks = $financialStatements['metadataResults']['ratioAnalysis']['dashboard']['net_margin']['remarks'];
        
        $comments = [
            'Very Poor' => "Business sustainability is in a very serious situation, requiring immediate improvements to remain viable.",
            'Poor' => 'Given the very slim margin, business may risk slipping into losses. Aggressive business development required to improve business sustainability.',
            'Moderate' => 'While margin remains within respectable level, business should explore reducing operational costs through comprehensive review of operations.',
            'Good' => 'Safe levels achieved by business to push performance to a higher level through better technology adoption.',
            'Excellent' => 'Continue to enhance IT systems to ensure continued efforts go towards enhancing values, reshaping business goals.'
        ];


        return "{$remarks} Net Margin by {$projectType} standards. " . $comments[$remarks];
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
            'industrial' => 10,
            'non-industrial' => 20,
        ];

        return $benchMarks[strtolower($projectType)];
    }
}