<?php

namespace Best\Pro\Financial\SingleYear;

class RawMaterialAnalysis
{
    public static function getReport($financialStatements)
    {

        $labels = ['Raw Materials Margin'];
        
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

        $marginRatio = ['raw_materials_margin'];

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
        $comments = [
            'Very Poor' => "Critical consideration to review existing suppliers and partners, widen the group of suppliers available and/or negotiate for a significant reduction in costs to ensure a healthy and sustainable business operations.",
            'Poor' => 'Strengthen partnership with existing supply partners to gain better price and improved margin',
            'Moderate' => 'While margin remains within modest levels, volatility in pricing due to external factors calls for a more cautious approach and risk diversification',
            'Good' => 'Positive margins could help in finding appropriatemale partner for further explansion',
            'Excellent' => 'Retain existing suppliers while continuing to monitor and reduce direct costs further optimising profits levels'
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