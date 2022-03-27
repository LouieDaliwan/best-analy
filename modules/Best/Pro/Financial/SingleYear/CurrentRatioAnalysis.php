<?php

namespace Best\Pro\Financial\SingleYear;


class CurrentRatioAnalysis
{
    public static function getReport($financialStatements)
    {

        $labels = ['Current Ratio'];
        
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

        $marginRatio = ['current_ratio'];

        foreach ($financialStatements as $statement) {

            $tempData = [];

            $profitability = $statement['metadataResults']['ratioAnalysis']['liquidity'];

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
        $remarks = $financialStatements['metadataResults']['ratioAnalysis']['dashboard']['gross_margin']['remarks'];

        $comments = [
            'Very Poor' => "Business may be in a critically difficult situation to be able to meet its short term financial obligations and will need to source for additional liquidity",
            'Poor' => 'A review of asset management while reducing short-term liabilities will be necessary to bring the business out of potential payment defaults.',
            'Moderate' => 'While asset to liquidity remains within the fence, efforts should go towards improving short term credits and risk analysis.',
            'Good' => 'Heatlhy net profit levels to be retained for now while exploring greater automation to further streamline the work process',
            'Excellent' => 'Continue to monitor and keep indicators monitored 24/7'
        ];

        
        return "{$remarks} Current Ratio by {$projectType} standards ". $comments[$remarks];
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