<?php

namespace Best\Pro\Financial\SingleYear;

class DebtRatioAnalysis
{
    public static function getReport($financialStatements)
    {
        $projectType = $financialStatements[0]['metadataResults']['ratioAnalysis']['dashboard']['project_type'];
        $score = round($financialStatements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'] * 100, 2);  
        $goodScore = self::getBenchMarkScore($projectType);

        $labels = [__("Debt Ratio ({$score}%)"), __("Recommended Good Score ({$goodScore}%)")];
        
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

        $marginRatio = ['debt_ratio'];

        foreach ($financialStatements as $statement) {

            $tempData = [];

            $projectType = $statement['metadataResults']['ratioAnalysis']['dashboard']['project_type'];
            $profitability = $statement['metadataResults']['ratioAnalysis']['solvency'];

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
        $remarks = $financialStatements['metadataResults']['ratioAnalysis']['dashboard']['debt_ratio']['remarks'];

        $comments = [
            'Very Poor' => "With a very heavy short and long-term financial burden, business may need to resort to bring in additional business partners while improving its asset proportion.",
            'Poor' => 'Rebalancing the books to strengthen the assets should be implemented to remain business viability while also attractingpotntial funding agencies.',
            'Moderate' => 'While asset to liquidity remains within the fence, efforts should go towards improving short term credits and risk analysis.',
            'Good' => 'Business is in a steadfast situation while keeping long term obligations within sufficient means.',
            'Excellent' => 'Recommended to maintaindebt levels.'
        ];
        
        return "{$remarks} Debt Ratio by {$projectType} standards. " . $comments[$remarks];
    }

    protected static function dataSet($data, $projectType)
    {
        $dataSet = [];

        $count = 0;

        foreach ($data as $period => $datum) {

            $isMostRecent = count($data) == ($count + 1) ? ' (most recent)' : '';

            $year = "{$period}{$isMostRecent}";

            $dataNumber = [
                $data[$period],
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
            'industrial' => 20,
            'non-industrial' => 20,
        ];

        return $benchMarks[strtolower($projectType)];
    }
}