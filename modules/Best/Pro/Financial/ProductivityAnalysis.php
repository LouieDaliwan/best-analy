<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;

/**
 * Analysis class for BEST formulas.
 *
 * @phpcs:disable
 */
abstract class ProductivityAnalysis extends AbstractAnalysis
{
    /**
     * Retrieve the report.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getReport($statements)
    {
        $labels = [__('Labour Cost Competitiveness')];
        return [
            'charts' => [
                'labels' => $labels,
                'dataset' => self::formatDataSet($statements)
            ],

            'comments' => [
                array_filter(self::getComment($statements)),
                // implode('||', self::getComment($spreadsheet)),
            ],
        ];
    }

    protected static function formatDataSet($statements)
    {
        $data = [];

        $productivity_items = ['labour_cost_competitiveness'];

        foreach ($statements as $statement) {

            $tempData = [];

            $productivity = $statement['metadataResults']['ratioAnalysis']['productivity'];

            foreach ($productivity_items as $item) {
                $value = $productivity[$item];
                $tempData[] = round($value, 2);
            }

            $data[$statement['period']] = $tempData;
        }


        return self::dataSet($data);
    }

    protected static function dataSet($data)
    {
        $dataSet = [];

        $color = ['#a2d5ac', '#3aada8', '#557c83'];

        $count = 0;

        foreach ($data as $period => $datum) {

            $bgColor = $color[$count];

            $isMostRecent = count($data) == ($count + 1) ? ' (' . __('most recent') . ')' : '';

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

    /**
     * Retrieve comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getComment($statements)
    {
        $ai43 = $statements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];

        $bc30 = collect($statements)->count() == 3 ? self::getBC30Comment($statements) : "";
        $bd30 = collect($statements)->count() == 3 ? self::getBD30Comment($statements) : "";
        $be30 = collect($statements)->count() == 2 ? self::getBE30Comment($statements) : "";
        $comment = [];

        if ($ai43 == "") {
            $comment[] = "";
        } else {
            if ($bc30 == "") {
                $comment[] = "";
            } else {
                $comment[] = $bc30;
            }
        }

        if ($bd30 == "") {
            $comment[] = "";
        } else {
            $comment[] = $bd30;
        }

        if ($be30 == "") {
            $comment[] = "";
        } else {
            $comment[] = $be30;
        }

        return $comment;
    }

    /**
     * Retrieve BC30 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return string
     */
    public static function getBC30Comment($statements)
    {
        $output = '';
        $ai69 = $statements[0]['metadataResults']['ratioAnalysis']['productivity']['labour_cost_competitiveness'];
        $ai70 = $statements[1]['metadataResults']['ratioAnalysis']['productivity']['labour_cost_competitiveness'];
        $ai71 = $statements[2]['metadataResults']['ratioAnalysis']['productivity']['labour_cost_competitiveness'];
        $bj30 = 0.5;

        if ($ai69 == '' && (($ai71 - $ai70) < 0)) {
            if (($ai71 - $ai70) < (-$bj30)) {
                $item1 = round(($ai71-$ai70)/$ai70*100, 2);
                $output = __("Overall labour cost competitiveness reflected a significant increasing trend by :item1%.", ['item1' => $item1]);
            } else {
                $item1 = round(($ai71-$ai70)/$ai70*100, 2);
                $output = __("Overall labour cost competitiveness reflected a slightly increasing trend by :item1%.", ['item1' => $item1]);
            }
        } else {
            if ($ai69 == '' && ($ai71-$ai70) > 0) {
                if (($ai71-$ai70) > $bj30) {
                    $item1 = round(($ai71-$ai70)/$ai70*100, 2);
                    $output = __("Overall labour cost competitiveness has seen a significant decline by :item1% over the years.", ['item1' => $item1]);
                } else {
                    $item1 = round(($ai71-$ai70)/$ai70*100, 2);
                    $output = __("Overall labour cost competitiveness has seen a marginal decline by :item1% over the years.", ['item1' => $item1]);
                }
            } else {
                if ($ai71>$ai70) {
                    $number1 = round(($ai71-$ai70)/$ai70*100, 2);
                    $output = __("Experienced a year on year increase by :number1% from the recent year to the previous year.", ['number1' => $number1]);
                } else {
                    $number1 = $ai70 != 0 ? round(($ai71-$ai70)/$ai70*100, 2): 0;
                    $output = __("Experienced a year on year decrease by :number1% from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BC30 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return string
     */
    public static function getBD30Comment($statements)
    {
        $output = '';
        $ai69 = $statements[0]['metadataResults']['ratioAnalysis']['productivity']['labour_cost_competitiveness'];
        $ai71 = $statements[2]['metadataResults']['ratioAnalysis']['productivity']['labour_cost_competitiveness'];
        $bi30 = 0.3;

        if ($ai69 == '') {
            $output = '';
        } else {
            if (($ai71 - $ai69) > 0) {
                if (($ai71 - $ai69) > $bi30) {
                    $output = __('Overall labour cost competitiveness recorded significant improvement over the 3 years.');
                } else {
                    $output = __('Overall labour cost competitiveness recorded an improvement over the 3 years.');
                }
            } else {
                if (($ai71 - $ai69) < (-$bi30)) {
                    $output = __("Overall labour cost competitiveness has seen a significant downward trend over the years.");
                } else {
                    $output = __("Overall labour cost competitiveness has seen a drop over the years.");
                }
            }
        }

        return $output;
    }


    /**
     * Retrieve BE30 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return string
     */
    public static function getBE30Comment($statements)
    {
        $output = '';
        $ai69 = $statements[0]['metadataResults']['ratioAnalysis']['productivity']['labour_cost_competitiveness'];
        $ai70 = $statements[1]['metadataResults']['ratioAnalysis']['productivity']['labour_cost_competitiveness'];
        $bk30 = 0.3;
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];

        if ($ai69 == '') {
            $output = '';
        } else {
            if (($ai70-$ai69) < 0) {
                if (($ai70-$ai69) < (-$bk30)) {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = round(($ai70-$ai69)/$ai69*100, 2);
                    $output = __("Records have also indicated that from :item1 to :item2, the per unit labour cost saw a significant year on year increase by :number1%.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = round(($ai70-$ai69)/$ai69*100, 2);
                    $output = __("Records have also indicated that from :item1 to :item2, the per unit labour cost saw a year on year increase by :number1%.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            } else {
                if (($ai70-$ai69) > 0) {
                    if (($ai70 - $ai69) > $bk30) {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = round(($ai70-$ai69)/$ai69*100, 2);
                        $output = __("Records have also indicated that from :item1 to :item2, the per unit labour cost saw a significant year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    } else {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = round(($ai70-$ai69)/$ai69*100, 2);
                        $output = __("Records have also indicated that from :item1 to :item2, the per unit labour cost saw a year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    }
                }
            }
        }

        return $output;
    }
}
