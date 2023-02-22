<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;
use Customer\Models\FinancialStatement;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;

/**
 * Analysis class for BEST formulas.
 *
 * @phpcs:disable
 */
abstract class ProfitabilityAnalysis extends AbstractAnalysis
{
    /**
     * Retrieve the report.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getReport($statements)
    {
        $labels = [
            [__('Gross'), __('Margin')],
            [__('Operating'), __('Margin')],
            [__('Net Margin'), __('After Tax')],
            __('ROA'),
            __('ROE'),
            [__('Operating'), __('Ratio')]
        ];

        return [
            'chart' => [
                'labels' => $labels,
                'dataset' => self::formatDataSet($statements),
            ],
            'comments' => [
                array_filter(self::getBF4Formula($statements)),
                array_filter(self::getBF5Formula($statements)),
                array_filter(self::getBF6Formula($statements)),
                array_filter(self::getBF7Formula($statements)),
                array_filter(self::getBF8Formula($statements)),
                array_filter(self::getBF9Formula($statements)),
            ],
        ];
    }

    protected static function formatDataSet($statements)
    {
        $data = [];

        $marginRatio = [
            'gross_profit_margin',
            'operating_profit_margin',
            'net_profit_margin',
            'return_on_assets',
            'return_on_equity',
            'operating_ratio'
        ];

        //TODO insert the minimum score if one period only exist in statement.

        foreach ($statements as $statement) {

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
                'backgroundColor' => [$bgColor, $bgColor, $bgColor, $bgColor, $bgColor, $bgColor],
            ];

            $count++;
        }

        return $dataSet;
    }

    /**
     * Retrieve AI43 comment.
     *
     *
     * @param  \Customer\Models\FinancialStatement   $statements
     * @param  string                                $key
     * @return array
     */
    public static function getAI43Comment($statements, $keyRatio = null)
    {
        //Period First latest
        if ($keyRatio == 'gross_profit') {

            // dd($statements);
            return $statements[0]['metadataResults']['ratioAnalysis']['profitability']['gross_profit_margin'];

        }

        return $statements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];
    }

    /**
     * Retrieve BF4 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @param  \Customer\Models\FinancialStatement    $statements
     *
     * @return array
     */
    public static function getBF4Formula($statements) : array
    {
        $comment = [];


        $h19 = self::getAI43Comment($statements, 'gross_profit');
        $bd4 = collect($statements)->count() == 3 ?self::getBD4Comment($statements) : "";
        $be4 = collect($statements)->count() == 3 ?self::getBE4Comment($statements) : "";
        $bf4 = collect($statements)->count() == 2 ?self::getBF4Comment($statements) : "";

        if ($h19 == ("" || 0)) {
            $comment[] = $be4;
        } else {
            if ($bd4 == "") {
                $comment[] = "";
            } else {
                $comment[] = $bd4;
            }
        }

        $comment[] = $be4;
        $comment[] = $bf4;

        return $comment;
    }

    /**
     * Retrieve BC4 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @param  \Customer\Models\FinancialStatement   $statements
     *
     * @return array
     */
    public static function getBD4Comment($statements)
    {
        $output = '';
        $bj4 = 0.3;
        $h19 = $statements[0]
        ['metadataResults']['ratioAnalysis']['profitability']['gross_profit_margin'];
        $h21 = $statements[2]
        ['metadataResults']['ratioAnalysis']['profitability']['gross_profit_margin'];


        if ($h19 == "") {
            $output = "";
        } else {
            if (($h21-$h19) > 0) {
                if (($h21-$h19)/$h19 > $bj4) {
                    $output = __("Overall gross margin trend reflected significant improvements.");
                } else {
                    $output = __("Overall gross margin trend reflected improvements.");
                }
            } else {
                if (($h21-$h19)/$h19 < (-$bj4)) {
                    $output = __("Overall gross profit trend has seen significant decline over the years.");
                } else {
                    $output = __("Overall gross profit trend has seen a decline over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD4 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @param  \Customer\Models\FinancialStatement   $statements
     *
     * @return array
     */
    public static function getBE4Comment($statements)
    {
        $output = '';

        $bk4 = 0.08;
        $h19 = $statements[0]
        ['metadataResults']['ratioAnalysis']['profitability']['gross_profit_margin'];
        $h20 = $statements[1]
        ['metadataResults']['ratioAnalysis']['profitability']['gross_profit_margin'];
        $h21 = $statements[2]
        ['metadataResults']['ratioAnalysis']['profitability']['gross_profit_margin'];


        $number1 = abs(round(($h21-$h20)*100, 2));
        if ($h19 == "" && ($h21-$h20) > 0) {
            if (($h21-$h20) > $bk4) {
                $output = __("Overall trend in gross profit margin reflected significant improvements by :number1%.", ['number1' => $number1]);
            } else {
                $output = __("Overall trend in gross profit margin reflected some improvements by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($h19 == "" && ($h21-$h20) < 0) {
                if(($h21-$h20) < (-$bk4)) {
                    $output = __("Overall gross profit has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $output = __("Overall gross profit has seen a decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($h21>$h20) {
                    $output = __("An increase of :number1% was recorded from the recent year to the previous year.", ['number1' => $number1]);
                } else {
                    $output = __("A decrease by :number1% was recorded from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE4 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @param  \Customer\Models\FinancialStatement   $statements
     *
     * @return array
     */
    public static function getBF4Comment($statements)
    {
        $output = '';

        $bl4 = 0.08;
        $h19 = $statements[0]
        ['metadataResults']['ratioAnalysis']['profitability']['gross_profit_margin'];
        $h20 = $statements[1]
        ['metadataResults']['ratioAnalysis']['profitability']['gross_profit_margin'];
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];
        $item1 = $d19;
        $item2 = $d20;


        $number1 = abs(round(($h20-$h19)*100, 2));

        if ($h20>$h19) {
            if(($h20-$h19) > $bl4) {
                $output = __("Records have also indicated that gross profits saw a significant year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            } else {
                $output = __("Records have also indicated that gross profits experienced a year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            }
        } else {
            if ($h20<$h19) {
                if (($h20-$h19) < (-$bl4)) {
                    $output = __("Records have also indicated that gross profits experienced a significant year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $output = __("Records have also indicated that gross profits experienced a year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            }
        }

        return $output;
    }


    /**
     * Retrieve BF5 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF5Formula($statements)
    {
        $comment = [];
        $ai43 = self::getAI43Comment($statements);
        $bc5 = collect($statements)->count() == 3 ? self::getBC5Comment($statements) : "";
        $bd5 = collect($statements)->count() == 3 ? self::getBD5Comment($statements) : "";
        $be5 = collect($statements)->count() == 2 ? self::getBE5Comment($statements) : "";

        if ($ai43 == ("" || 0)) {
            $comment[] = $bd5;
        } else {
            $comment[] = $bc5;
        }

        $comment[] = $bd5;
        $comment[] = $be5;

        return $comment;
    }

    /**
     * Retrieve BC5 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC5Comment($statements)
    {
        $output = '';
        $k19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['operating_profit_margin'];
        $k21 = $statements[2]['metadataResults']['ratioAnalysis']['profitability']['operating_profit_margin'];
        $bi5 = 0.3;

        if ($k19 == "") {
            $output = "";
        } else {
            if (($k21-$k19)/$k19 > 0) {
                if (($k21-$k19)/$k19>$bi5) {
                    $output = __("Overall operating margin reflected a significant increasing trend.");
                } else {
                    $output = __("Overall operating margin reflected an increasing trend.");
                }
            } else {
                if (($k21-$k19)/$k19 < (-$bi5)) {
                    $output = __("Overall operating profit has seen a significant decline over the years.");
                } else {
                    $output = __("Overall operating profit has seen a decline over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD5 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD5Comment($statements)
    {
        $output = '';
        $bj5 = 0.05;
        $k19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['operating_profit_margin'];
        $k20 = $statements[1]['metadataResults']['ratioAnalysis']['profitability']['operating_profit_margin'];
        $k21 = $statements[2]['metadataResults']['ratioAnalysis']['profitability']['operating_profit_margin'];

        $number1 = abs(round(($k21-$k20)*100, 2));

        if ($k19 == "" && ($k21-$k20) > 0) {
            if (($k21-$k20) > ($bj5)) {
                $output = __("Overall operating profit margin reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            } else {
                $output = __("Overall operating profit margin reflected an increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if($k19 == "" && ($k21-$k20) < 0) {
                if(($k21-$k20) < (-$bj5)) {
                    $output = __("Overall operating profit has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $output = __("Overall operating profit has seen a decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($k21>$k20) {
                    $output = __("Recent year saw an increase of :number1% from the previous year.", ['number1' => $number1]);
                } else {
                    $output = __("Recent year saw a decrease of :number1% from the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE5 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE5Comment($statements)
    {
        $output = '';

        $bk5 = 0.05;
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];
        $k19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['operating_profit_margin'];
        $k20 = $statements[1]['metadataResults']['ratioAnalysis']['profitability']['operating_profit_margin'];
        $item1 = $d19;
        $item2 = $d20;

        $number1 = abs(round(($k20-$k19)*100, 2));
        if ($k20 > $k19) {
            if (($k20-$k19) > $bk5) {
                $output = __("Records have also indicated that operating profits saw a significant year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            } else {
                $output = __("Records have also indicated that operating profits experienced a year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            }
        } else {
            if ($k20 < $k19) {
                if (($k20-$k19) < (-$bk5)) {

                    $output = __("Records have also indicated that operating profits experienced a significant year on year decrease by :number1% from :item1 to :item2", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $output = __("Records have also indicated that operating profits experienced a year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BF6 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF6Formula($statements)
    {
        $comment = [];

        $ai43 = self::getAI43Comment($statements);
        $bc6 = collect($statements)->count() == 3 ? self::getBC6Comment($statements) : "";
        $bd6 = collect($statements)->count() == 3 ? self::getBD6Comment($statements) : "";
        $be6 = collect($statements)->count() == 2 ? self::getBE6Comment($statements) : "";

        if ($ai43 == ("" || 0) ) {
            $comment[] = $bd6;
        } else {
            if ($bc6 == "") {
                $comment[] = "";
            } else {
                $comment[] = $bc6;
            }
        }

        $comment[] = $bd6;
        $comment[] = $be6;

        return $comment;
    }

    /**
     * Retrieve BC6 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC6Comment($statements)
    {
        $output = '';
        $bi6 = 0.3;
        $n19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['net_profit_margin'];
        $n21 = $statements[2]['metadataResults']['ratioAnalysis']['profitability']['net_profit_margin'];

        if ($n19 == "") {
            $output = "";
        } else {
            if (($n21-$n19)/$n19 > 0) {
                if (($n21-$n19)/$n19>$bi6) {
                    $output = __("Overall net margin reflected a significant increasing trend.");
                }
            } else {
                if (($n21-$n19)/$n19 < (-$bi6)) {
                    $output = __("Overall net profit has seen a significant decline over the years.");
                } else {
                    $output = __("Overall net profit has seen a decline over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD6 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD6Comment($statements)
    {
        $output = '';
        $bj6 = 0.03;
        $n19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['net_profit_margin'];
        $n20 = $statements[1]['metadataResults']['ratioAnalysis']['profitability']['net_profit_margin'];
        $n21 = $statements[2]['metadataResults']['ratioAnalysis']['profitability']['net_profit_margin'];

        $number1 = abs(round(($n21-$n20)*100, 2));

        if ($n19 == "" && ($n21-$n20) > 0) {
            if (($n21-$n20) > $bj6) {
                $output = __("Overall net gross profit margin improved, reflecting a significant increasing trend by :number1%.");
            } else {
                $output = __("Overall net gross profit margin, improved, reflecting an increasing trend by :number1%.");
            }
        } else {
            if ($n19 == "" && ($n21-$n20) < 0) {
                if (($n21-$n20) < (-$bj6)) {
                    $output = __("Overall net profit took a dip, a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $output = __("Overall net profit took a dip, declining by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($n21 > $n20) {
                    $output = __("Recent year experienced an increase by :number1% compared to the previous year.", ['number1' => $number1]);
                } else {
                    $output = __("Recent year experienced a decrease of :number1% when compared to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE6 comment.
     *
     * @param \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE6Comment($statements)
    {
        $output = '';

        $n19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['net_profit_margin'];
        $n20 = $statements[1]['metadataResults']['ratioAnalysis']['profitability']['net_profit_margin'];

        $bk6 = 0.03;
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];

        if ($n20>$n19) {
            if (($n20-$n19) > $bk6) {
                $item1 = $d19;
                $item2 = $d20;
                $number1 = abs(round(($n20-$n19)*100, 2));
                $output = __("Records have also indicated that net profits saw a significant year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            } else {
                $item1 = $d19;
                $item2 = $d20;
                $number1 = abs(round(($n20-$n19)*100, 2));
                $output = __("Records have also indicated that net profits experienced a year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            }
        } else {
            if ($n20<$n19) {
                if (($n20-$n19) < (-$bk6)) {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = abs(round(($n20-$n19)*100, 2));
                    $output = __("Records have also indicated that net profits experienced a significant year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = abs(round(($n20-$n19)*100, 2));
                    $output = __("Records have also indicated that net profits experienced a year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BF7 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF7Formula($statements)
    {
        $comment = [];

        $ai43 = self::getAI43Comment($statements);
        $bc7 =  collect($statements)->count() == 3 ? self::getBC7Comment($statements) : "";
        $bd7 =  collect($statements)->count() == 3 ? self::getBD7Comment($statements) : "";
        $be7 =  collect($statements)->count() == 2 ? self::getBE7Comment($statements) : "";

        if ($ai43 == ("" || 0)) {
            $comment[] = $bd7;
        } else {
            $comment[] = $bc7;
        }

        $comment[] = $bd7;
        $comment[] = $be7;

        return $comment;
    }

    /**
     * Retrieve BC7 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC7Comment($statements)
    {
        $output = '';
        $bi7 = 0.3;
        $q19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['return_on_assets'];
        $q21 = $statements[2]['metadataResults']['ratioAnalysis']['profitability']['return_on_assets'];

        if ($q19 == "") {
            $output = "";
        } else {
            if (($q21-$q19)/$q19 > 0) {
                if (($q21-$q19)/$q19 > $bi7) {
                    $output = __("Overall return on asset (ROA) reflected a significant increasing trend.");
                } else {
                    $output = __("Overall return on asset (ROA) reflected an increasing trend.");
                }
            } else {
                if (($q21-$q19)/$q19 < (-$bi7)) {
                    $output = __("Overall return on asset (ROA) has seen a significant decline over the years.");
                } else {
                    $output = __("Overall return on asset (ROA) has seen a decline over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD7 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD7Comment($statements)
    {
        $output = '';
        $bj7 = 0.08;
        $q19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['return_on_assets'];
        $q20 = $statements[1]['metadataResults']['ratioAnalysis']['profitability']['return_on_assets'];
        $q21 = $statements[2]['metadataResults']['ratioAnalysis']['profitability']['return_on_assets'];

        $number1 = abs(round(($q21-$q20)*100, 2));

        if ($q19 == "" && ($q21-$q20) > 0) {
            if (($q21-$q20) > $bj7) {
                $output = __("Overall return on assets reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($q19 == "" && ($q21-$q20) < 0) {
                if (($q21-$q20) < (-$bj7)) {
                    $output = __("Overall return on assets has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $output = __("Overall return on assets has seen a decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($q21>$q20) {
                    $output = __("A :number1% increase was recorded from the recent year to the previous year.", ['number1' => $number1]);
                } else {
                    $output = __("A :number1% decrease was recorded from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE7 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE7Comment($statements)
    {
        $output = '';
        $bk7 = 0.08;
        $q19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['return_on_assets'];
        $q20 = $statements[1]['metadataResults']['ratioAnalysis']['profitability']['return_on_assets'];
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];

        $item1 = $d19;
        $item2 = $d20;
        $number1 = abs(round(($q20-$q19)*100, 2));

        if ($q20 > $q19) {
            if (($q20-$q19) > $bk7) {
                $output = __("Records have also indicated that the ROA saw a significant year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            } else {
                $output = __("Records have also indicated that the ROA experienced a year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            }
        } else {
            if ($q20 < $q19) {
                if (($q20-$q19) < (-$bk7)) {
                    $output = __("Records have also indicated that the ROA experienced a significant year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $output = __("Records have also indicated that the ROA experienced a year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            }
        }

        return $output;
    }


    /**
     * Retrieve BF8 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF8Formula($statements)
    {
        $comment = [];

        $ai43 = self::getAI43Comment($statements);
        $bc8 = collect($statements)->count() == 3 ? self::getBC8Comment($statements) : "";
        $bd8 = collect($statements)->count() == 3 ? self::getBD8Comment($statements) : "";
        $be8 = collect($statements)->count() == 2 ? self::getBE8Comment($statements) : "";

        if ($ai43 == ("" || 0)) {
            $comment[] = $bd8;
        } else {
            if ($bc8 == "") {
                $comment[] = "";
            } else {
                $comment[] = $bc8;
            }
        }

        $comment[] = $bd8;
        $comment[] = $be8;

        return $comment;
    }

    /**
     * Retrieve BC8 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC8Comment($statements)
    {
        $output = '';
        $t19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['return_on_equity'];
        $t21 = $statements[2]['metadataResults']['ratioAnalysis']['profitability']['return_on_equity'];
        $bi8 = 0.3;

        if ($t19 == "") {
            $output = "";
        } else {
            if (($t21-$t19)/$t19 > 0) {
                if (($t21-$t19)/$t19 > $bi8) {
                    $output = __("Overall return on equity (ROE) reflected a significant increasing trend.");
                } else {
                    $output = __("Overall return on equity (ROE) reflected an increasing trend.");
                }
            } else {
                if (($t21-$t19)/$t19 < (-$bi8)) {
                    $output = __("Overall return on equity (ROE) has seen a significant decline over the years.");
                } else {
                    $output = __("Overall return on equity (ROE) has seen a decline over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD8 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD8Comment($statements)
    {
        $output = '';
        $t19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['return_on_equity'];
        $t20 = $statements[1]['metadataResults']['ratioAnalysis']['profitability']['return_on_equity'];
        $t21 = $statements[2]['metadataResults']['ratioAnalysis']['profitability']['return_on_equity'];
        $bj8 = 0.08;

        if ($t19 == "" && ($t21-$t20) > 0) {
            if (($t21-$t20)>$bj8) {
                $number1 = abs(round(($t21-$t20)*100, 2));
                $output = __("Overall return on equity reflected a significant increasing trend by :number1%.", [
                    'number1' => $number1]);
            } else {
                $number1 = abs(round(($t21-$t20)*100, 2));
                $output = __("Overall return on equity reflected an increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($t19 == "" && ($t21-$t20) < 0) {
                if (($t21-$t20) < (-$bj8)) {
                    $number1 = abs(round(($t21-$t20)*100, 2));
                    $output = __("Overall return on equity has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($t21-$t20)*100, 2));
                    $output = __("Overall return on equity has seen a decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($t21 > $t20) {
                    $number1 = abs(round(($t21-$t20)*100, 2));
                    $output = __("ROE increased by :number1% from the recent year to the previous year.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($t21-$t20)*100, 2));
                    $output = __("ROE decreased by :number1% from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE8 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE8Comment($statements)
    {
        $output = '';

        $t19 = $statements[0]['metadataResults']['ratioAnalysis']['profitability']['return_on_equity'];
        $t20 = $statements[1]['metadataResults']['ratioAnalysis']['profitability']['return_on_equity'];
        $bk8 = 0.08;
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];

        $item1 = $d19;
        $item2 = $d20;
        $number1 = abs(round(($t20-$t19)*100, 2));

        if ($t20>$t19) {
            if (($t20-$t19)>$bk8) {
                $output = __("Records have also indicated that the ROE saw a significant year on year increase by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
            } else {
                $output = __("Records have also indicated that the ROE experienced a year on year increase by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
            }
        } else {
            if ($t20<$t19) {
                if (($t20-$t19) < (-$bk8)) {
                    $output = __("Records have also indicated that the ROE experienced a significant year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $output = __("Records have also indicated that the ROE experienced a year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            }
        }

        return $output;
    }


    /**
     * Retrieve BF9 formula.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBF9Formula($statements)
    {
        $comment = [];

        $ai43 = self::getAI43Comment($statements);
        $bc9 = collect($statements)->count() == 3 ? self::getBC9Comment($statements) : "";
        $bd9 = collect($statements)->count() == 3 ? self::getBD9Comment($statements) : "";
        $be9 = collect($statements)->count() == 2 ? self::getBE9Comment($statements) : "";

        if ($ai43 == ("" || 0)) {
            $comment[] = $bd9;
        } else {
            $comment[] = $bc9;
        }

        $comment[] = $bd9;
        $comment[] = $be9;

        return $comment;
    }

    /**
     * Retrieve BC4 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC9Comment($statements)
    {
        $output = '';

        $w19 = (float) str_replace(':1', "", $statements[0]['metadataResults']['ratioAnalysis']['profitability']['operating_ratio']);
        $w21 = (float) str_replace(':1', "", $statements[2]['metadataResults']['ratioAnalysis']['profitability']['operating_ratio']);
        $bi9 = 0.3;

        if ($w19 == "") {
            $output = "";
        } else {
            if (($w21-$w19)/$w19 > 0) {
                if (($w21-$w19)/$w19 > $bi9) {
                    $output = __("Overall operating ratio reflected a significant improvements over the years.");
                } else {
                    $output = __("Overall operating ratio reflected improvements over the years.");
                }
            } else {
                if (($w21-$w19)/$w19< (-$bi9)) {
                    $output = __("Overall operating ratio has seen a significant dip over the years.");
                } else {
                    $output = __("Overall operating ratio has seen a dip over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BC4 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD9Comment($statements)
    {
        $output = '';
        $bj9 = 0.08;
        $w19 = (float) str_replace(':1', "", $statements[0]['metadataResults']['ratioAnalysis']['profitability']['operating_ratio']);
        $w20 = (float) str_replace(':1', "", $statements[1]['metadataResults']['ratioAnalysis']['profitability']['operating_ratio']);
        $w21 = (float) str_replace(':1', "", $statements[2]['metadataResults']['ratioAnalysis']['profitability']['operating_ratio']);

        $number1 = abs(round(($w21-$w20)*100, 2));

        if ($w19 == "" && ($w21-$w20)>0) {
            if (($w21-$w20) > $bj9) {
                $output = __("Overall operating ratio reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            } else {
                $output = __("Overall operating ratio reflected an increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($w19 == "" && ($w21-$w20) < 0) {
                if (($w21-$w20) < (-$bj9)) {
                    $output = __("Overall operating ratio has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $output = __("Overall operating ratio has seen a decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($w21>$w20) {
                    $output = __("An increase of :number1% was achieved from the recent year to the previous year.", ['number1' => $number1]);
                } else {
                    $output = __("A dip of :number1% was recorded from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BC4 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE9Comment($statements)
    {
        $output = '';
        $bk9 = 0.08;

        $w19 = (float) str_replace(':1', "", $statements[0]['metadataResults']['ratioAnalysis']['profitability']['operating_ratio']);
        $w20 = (float) str_replace(':1', "", $statements[1]['metadataResults']['ratioAnalysis']['profitability']['operating_ratio']);

        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];
        $item1 = $d19;
        $item2 = $d20;

        $number1 = abs(round(($w20-$w19)*100, 2));

        if ($w20>$w19) {
            if (($w20-$w19) > $bk9) {
                $output = __("Records have also indicated that the operating ratio saw a significant year on year increase by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
            } else {
                $output = __("Records have also indicated that the operating ratio experienced a year on year increase by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
            }
        } else {
            if ($w20<$w19) {
                if (($w20-$w19) < (-$bk9)) {
                    $output = __("Records have also indicated that the operating ratio experienced a significant year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $output = __("Records have also indicated that the operating ratio experienced a year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            }
        }

        return $output;
    }

}
