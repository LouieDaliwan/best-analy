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
    protected static function getStatements($customer)
    {
        return FinancialStatement::where('customer_id', $customer->id)
        ->orderBy('period', 'desc')
        ->take(3)
        ->get()
        ->sortBy('period')
        ->toArray();
    }

    /**
     * Retrieve the report.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public static function getReport(Customer $customer)
    {
        $statements = self::getStatements($customer);

        $spreadsheet = self::getSpreadsheet($customer);

        $labels = ['Gross Margin', 'Operating Margin',' Net Margin After Tax', 'ROA', 'ROE', 'Op. Ratio'];

        return [
            'chart' => [
                'labels' => $labels,
                'dataset' => self::formatDataSet($statements),
            ],
            'comment' => [
                self::getBF4Formula($spreadsheet, $statements),
                self::getBF5Formula($spreadsheet, $statements),
                self::getBF6Formula($spreadsheet, $statements),
                self::getBF7Formula($spreadsheet, $statements),
                self::getBF8Formula($spreadsheet, $statements),
                self::getBF9Formula($spreadsheet, $statements),
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
                $tempData[] = $item == 'operating_ratio' ? (int) str_replace(':1', "", $profitability[$item]) : $profitability[$item];;
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

    /**
     * Retrieve AI43 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @param  \Customer\Models\FinancialStatement   $statements
     * @return array
     */
    public static function getAI43Comment($spreadsheet, $statements)
    {
        //Year1 Debt Ratio
        return $statements[0]['metadataResults']
        ['ratioAnalysis']['profitability']['gross_profit_margin'];

        // return $spreadsheet->getCell('AI43')->getCalculatedValue();
    }

    /**
     * Retrieve BF4 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @param  \Customer\Models\FinancialStatement    $statements
     *
     * @return array
     */
    public static function getBF4Formula($spreadsheet, $statements) : array
    {
        $comment = [];

        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');

        $h19 = self::getAI43Comment($sp ,$statements);
        $bd4 = self::getBD4Comment($sp, $statements);
        $be4 = self::getBE4Comment($sp, $statements);
        $bf4 = self::getBF4Comment($sp, $statements);

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
    public static function getBD4Comment($spreadsheet, $statements)
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
    public static function getBE4Comment($spreadsheet, $statements)
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
    public static function getBF4Comment($spreadsheet, $statements)
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
    public static function getBF5Formula($spreadsheet, $statements)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp, $statements);
        $bc5 = self::getBC5Comment($sp);
        $bd5 = self::getBD5Comment($sp);
        $be5 = self::getBE5Comment($sp);
        if ($ai43 == "") {
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
    public static function getBC5Comment($spreadsheet)
    {
        $output = '';
        $k19 = $spreadsheet->getCell('K19')->getCalculatedValue();
        $k21 = $spreadsheet->getCell('K20')->getCalculatedValue() ?: 0;
        $bi5 = $spreadsheet->getCell('BI5')->getCalculatedValue() ?: 0;

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
    public static function getBD5Comment($spreadsheet)
    {
        $output = '';
        $bj5 = $spreadsheet->getCell('BJ5')->getCalculatedValue() ?: 0;
        $k19 = $spreadsheet->getCell('K19')->getCalculatedValue();
        $k20 = $spreadsheet->getCell('K20')->getCalculatedValue() ?: 0;
        $k21 = $spreadsheet->getCell('K21')->getCalculatedValue() ?: 0;

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
    public static function getBE5Comment($spreadsheet)
    {
        $output = '';
        $bk5 = $spreadsheet->getCell('BK5')->getCalculatedValue() ?: 0;
        $k19 = $spreadsheet->getCell('K19')->getCalculatedValue() ?: 0;
        $k20 = $spreadsheet->getCell('K20')->getCalculatedValue() ?: 0;
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue() ?: 0;
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue() ?: 0;
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
                    $output = __("Records have also indicated that operating profits experienced a significant year on year decrease by :number1% from :item1 to :item2.", [
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
    public static function getBF6Formula($spreadsheet, $statements)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp, $statements);
        $bc6 = self::getBC6Comment($sp);
        $bd6 = self::getBD6Comment($sp);
        $be6 = self::getBE6Comment($sp);

        if ($ai43 =="") {
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC6Comment($spreadsheet)
    {
        $output = '';
        $bi6 = $spreadsheet->getCell('BI6')->getCalculatedValue() ?: 0;
        $n19 = $spreadsheet->getCell('N19')->getCalculatedValue();
        $n21 = $spreadsheet->getCell('N21')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD6Comment($spreadsheet)
    {
        $output = '';
        $bj6 = $spreadsheet->getCell('BJ6')->getCalculatedValue() ?: 0;
        $n19 = $spreadsheet->getCell('N19')->getCalculatedValue();
        $n20 = $spreadsheet->getCell('N20')->getCalculatedValue() ?: 0;
        $n21 = $spreadsheet->getCell('N21')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE6Comment($spreadsheet)
    {
        $output = '';
        $n19 = $spreadsheet->getCell("N19")->getCalculatedValue() ?: 0;
        $n20 = $spreadsheet->getCell("N20")->getCalculatedValue() ?: 0;
        $bk6 = $spreadsheet->getCell('BK6')->getCalculatedValue() ?: 0;
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue() ?: 0;
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue() ?: 0;

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
    public static function getBF7Formula($spreadsheet, $statements)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp, $statements);
        $bc7 = self::getBC7Comment($sp);
        $bd7 = self::getBD7Comment($sp);
        $be7 = self::getBE7Comment($sp);

        if ($ai43 == "") {
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC7Comment($spreadsheet)
    {
        $output = '';
        $bi7 = $spreadsheet->getCell('BI7')->getCalculatedValue() ?: 0;
        $q19 = $spreadsheet->getCell('Q19')->getCalculatedValue();
        $q21 = $spreadsheet->getCell('Q21')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD7Comment($spreadsheet)
    {
        $output = '';
        $bj7 = $spreadsheet->getCell('BJ7')->getCalculatedValue() ?: 0;
        $q19 = $spreadsheet->getCell('Q19')->getCalculatedValue() ?: 0;
        $q20 = $spreadsheet->getCell('Q20')->getCalculatedValue() ?: 0;
        $q21 = $spreadsheet->getCell('Q21')->getCalculatedValue() ?: 0;
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE7Comment($spreadsheet)
    {
        $output = '';
        $bk7 = $spreadsheet->getCell('BK7')->getCalculatedValue() ?: 0;
        $q19 = $spreadsheet->getCell('Q19')->getCalculatedValue() ?: 0;
        $q20 = $spreadsheet->getCell('Q20')->getCalculatedValue() ?: 0;
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue() ?: 0;
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue() ?: 0;
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
    public static function getBF8Formula($spreadsheet, $statements)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp, $statements);
        $bc8 = self::getBC8Comment($sp);
        $bd8 = self::getBD8Comment($sp);
        $be8 = self::getBE8Comment($sp);

        if ($ai43 == "") {
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC8Comment($spreadsheet)
    {
        $output = '';
        $t19 = $spreadsheet->getCell('T19')->getCalculatedValue();
        $t21 = $spreadsheet->getCell('T21')->getCalculatedValue() ?: 0;
        $bi8 = $spreadsheet->getCell('BI8')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD8Comment($spreadsheet)
    {
        $output = '';
        $t19 = $spreadsheet->getCell('T19')->getCalculatedValue();
        $t20 = $spreadsheet->getCell('T20')->getCalculatedValue() ?: 0;
        $t21 = $spreadsheet->getCell('T21')->getCalculatedValue() ?: 0;
        $bj8 = $spreadsheet->getCell('BJ8')->getCalculatedValue() ?: 0;
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE8Comment($spreadsheet)
    {
        $output = '';

        $bk8 = $spreadsheet->getCell('BK8')->getCalculatedValue() ?: 0;
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue() ?: 0;
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue() ?: 0;
        $t19 = $spreadsheet->getCell('T19')->getCalculatedValue() ?: 0;
        $t20 = $spreadsheet->getCell('T20')->getCalculatedValue() ?: 0;
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF9Formula($spreadsheet, $statements)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp, $statements);
        $bc9 = self::getBC9Comment($sp);
        $bd9 = self::getBD9Comment($sp);
        $be9 = self::getBE9Comment($sp);

        if ($ai43 == "") {
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC9Comment($spreadsheet)
    {
        $output = '';
        $w19 = $spreadsheet->getCell('W19')->getCalculatedValue();
        $w21 = $spreadsheet->getCell('W21')->getCalculatedValue() ?: 0;
        $bi9 = $spreadsheet->getCell('BI9')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD9Comment($spreadsheet)
    {
        $output = '';
        $bj9 = $spreadsheet->getCell('BJ9')->getCalculatedValue() ?: 0;
        $w19 = $spreadsheet->getCell('W19')->getCalculatedValue();
        $w20 = $spreadsheet->getCell('W20')->getCalculatedValue() ?: 0;
        $w21 = $spreadsheet->getCell('W21')->getCalculatedValue() ?: 0;
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE9Comment($spreadsheet)
    {
        $output = '';
        $bk9 = $spreadsheet->getCell('BK9')->getCalculatedValue() ?: 0;
        $w19 = $spreadsheet->getCell('W19')->getCalculatedValue() ?: 0;
        $w20 = $spreadsheet->getCell('W20')->getCalculatedValue() ?: 0;
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue() ?: 0;
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue() ?: 0;
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
