<?php

namespace Best\Pro\Financial\SingleYear;

class GrossMarginAnalysis
{
    public static function getReport($financialStatements)
    {
        $labels = ['Gross Profit Margin'];
        
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

        $marginRatio = ['gross_profit_margin'];

        foreach ($financialStatements as $statement) {

            $tempData = [];

            $profitability = $statement['metadataResults']['ratioAnalysis']['profitability'];

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
            'Very Poor' => "Immediate focus would be to re-strategise the production process and choice of raw materials suppliers to ensure a healthier gross profit margin",
            'Poor' => 'Serious consideration to seek alternative suppliers to significantly improve profitability',
            'Moderate' => 'Room to expand and explore several other suppliers to further reduce cost of goods sold.',
            'Good' => 'To remain sustainable, good to explore additional suppliers to improve profitability',
            'Excellent' => 'To continue be cautious of potential cost increase due to external factors and changing economic situation.'
        ];

        
        return "{$remarks} Gross  Margin by {$projectType} standards " . $comments[$remarks];
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