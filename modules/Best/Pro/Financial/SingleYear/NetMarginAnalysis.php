<?php

namespace Best\Pro\Financial\SingleYear;

class NetMarginAnalysis
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
                self::getComment($financialStatements),
            ],
        ];
    }

    protected static function formatDataSet($financialStatements)
    {
        $data = [];

        $marginRatio = ['net_profit_margin'];

        foreach ($financialStatements as $statement) {

            $tempData = [];

            $profitability = $statement['metadataResults']['ratioAnalysis']['profitability'];

            foreach ($marginRatio as $item) {
                $value = $item == 'operating_ratio' ? (float) str_replace(':1', "", $profitability[$item]): $profitability[$item];

                $tempData[] = round($value * 100, 2);
            }

            $data[$statement['period']] = $tempData;
        }

        return self::dataSet($data);
    }

    protected static function getComment($financialStatements)
    {
        $comments = [
            'Very Poor' => "Business sustainability is in a very serious situation, requiring immediate improvements to remain viable",
            'Poor' => 'Given the very slim margin, business may risk slipping into losses. Aggressive business development required to improve business sustainability',
            'Moderate' => 'While margin remains within respectable level, business should explore reducing operational costs through comprehensive review of operations.',
            'Good' => 'Safe levels achieved by business to push performance to a higher level through better technology adoption.',
            'Excellent' => 'Continue to enhance IT systems to ensure continued efforts go towards enhancing values, reshaping business goals'
        ];

        
        return $comments[$financialStatements['metadataResults']['ratioAnalysis']['dashboard']['gross_margin']['Excellent']];
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