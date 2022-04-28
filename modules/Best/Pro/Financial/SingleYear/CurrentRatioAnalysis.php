<?php

namespace Best\Pro\Financial\SingleYear;


class CurrentRatioAnalysis
{
    public static function getReport($financialStatements)
    {
        $projectType = strtolower(
            str_replace(
            ' ', 
            '-', 
            $financialStatements[0]['metadataResults']['ratioAnalysis']['dashboard']['project_type'])
        ); 
        $score = round((float) str_replace(':1', "", $financialStatements[0]['metadataResults']['ratioAnalysis']['liquidity']['current_ratio']), 2);
        $goodScore = self::getBenchMarkScore($projectType);
        $year = $financialStatements[0]['period'];

        $labels = [
            'preview' => ["{$year} ({$score}%)", __("Recommended ({$goodScore}%)")],
            'pdf' => ["{$year} ({$score}%)", "Recommended ({$goodScore}%)"],
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

        $marginRatio = ['current_ratio'];

        foreach ($financialStatements as $statement) {

            $tempData = [];

            $profitability = $statement['metadataResults']['ratioAnalysis']['liquidity'];

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

        $remarks = $financialStatements['metadataResults']['ratioAnalysis']['dashboard']['current_ratio']['remarks'];

        $comments = [
            'Very Poor' => "Business may be in a critically difficult situation to be able to meet its short term financial obligations and will need to source for additional liquidity",
            'Poor' => 'A review of asset management while reducing short-term liabilities will be necessary to bring the business out of potential payment defaults',
            'Moderate' => 'While asset to liquidity remains within the fence, efforts should go towards improving short term credits and risk analysis',
            'Good' => 'Heatlhy net profit levels to be retained for now while exploring greater automation to further streamline the work process',
            'Excellent' => 'Continue to monitor and keep indicators monitored 24/7'
        ];

        return __("{$remarks} Current Ratio by {$projectType} standards"). '. ' . __($comments[$remarks]);
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
            'industrial' => 1.25,
            'non-industrial' => 1.5,
        ];

        return $benchMarks[strtolower($projectType)];
    }
}