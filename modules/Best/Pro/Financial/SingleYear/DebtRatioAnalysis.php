<?php

namespace Best\Pro\Financial\SingleYear;

class DebtRatioAnalysis
{
    public static function getReport($financialStatements)
    {

        $labels = ['Debt Ratio'];
        
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

            $profitability = $statement['metadataResults']['ratioAnalysis']['solvency'];

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
            'Very Poor' => "With a very heavy short and long-term financial burden, business may need to resort to bring in additional business partners while improving its asset proportion.",
            'Poor' => 'Rebalancing the books to strengthen the assets should be implemented to remain business viability while also attractingpotntial funding agencies',
            'Moderate' => 'While asset to liquidity remains within the fence, efforts should go towards improving short term credits and risk analysis.',
            'Good' => 'Business is in a steadfast situation while keeping long term obligations within sufficient means',
            'Excellent' => 'Recommended to maintaindebt levels'
        ];
        
        return "{$remarks} Debt Ratio by {$projectType} standards " . $comments[$remarks];
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