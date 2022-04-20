<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;

/**
 * Analysis class for BEST formulas.
 *
 * @phpcs:disable
 */
abstract class EfficiencyAnalysis extends AbstractAnalysis
{
    /**
     * Retrieve the report.
     *
     * @param  \Customer\Models\FinancialStatement
     * @param  \Customer\Models\Customer;
     * @return array
     */
    public static function getReport($statements, $customer)
    {
        $labels = ['Trade Receivables (days)', 'Trade Payable (days)', 'Asset Turnover', 'Inventory Turnover'];

        return [
            'charts' => [
                'labels' => $labels,
                'dataset' => self::formatDataset($statements),
            ],

            'comments' => [
                self::getBF17Comment($statements, $customer),
                self::getBF18Comment($statements),
                self::getBF19Comment($statements),
                self::getBF20Comment($statements),
            ],
        ];
    }

    protected static function formatDataset($statements)
    {
        $data = [];

        $efficiency_items = [
            'avg_trade_receivable_turnover_days',
            'avg_trade_payable_turnover_days',
            'assets_turnover_ratio',
            'inventory_turnover_ratio',
        ];

        foreach ($statements as $statement) {

            $tempData = [];

            $efficiency = $statement['metadataResults']['ratioAnalysis']['efficiency'];

            foreach ($efficiency_items as $item) {

                $value = $efficiency[$item];

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
     * Retrieve BF17 formula.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @param  \Customer\Models\Customer           $customer
     * @return array
     */
    public static function getBF17Comment($statements, $customer)
    {
        $comment = [];

        $ai43 = self::getAI43Comment($statements);
        $bc17 = collect($statements)->count() == 3  ? self::getBC17Comment($statements) : "";
        $bd17 = collect($statements)->count() == 3  ? self::getBD17Comment($statements, $customer) : "";
        $be17 = collect($statements)->count() == 2  ? self::getBE17Comment($statements) : "";

        if ($ai43 == "") {
            $comment[] = $bd17;
        } else {
            if($bc17 == "") {
                $comment[] = "";
            } else {
                $comment[] = $bc17;
            }
        }

        if ($bd17 == "") {
            $comment[] = "";
        } else {
            $comment[] = $bd17;
        }

        if ($be17 == "") {
            $comment[] = "";
        } else {
            $comment[] = $be17;
        }

        return $comment;
    }

    /**
     * Retrieve AI43 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getAI43Comment($statements)
    {
        return $statements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];
    }

    /**
     * Retrieve BC17 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC17Comment($statements)
    {
        $output = '';

        $h43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days'];
        $h45 = $statements[2]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days'];
        $bi17 = 0.3;

        if ($h43 == 0) {
            $output = "";
        } else {
            if (($h45-$h43) / $h43 > 0) {
                if (($h45-$h43)/$h43 > $bi17) {
                    $output = __("Overall trade receivables recorded significant improvement over the 3 years.");
                } else {
                    $output = __("Overall trade receivables recorded an improvement over the 3 years.");
                }
            } else {
                if (($h45-$h43)/$h43 < (-$bi17)) {
                    $output = __("Overall trade receivables has seen a significant downward trend over the years.");
                } else {
                    $output = __("Overall trade receivables has seen a drop over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD17 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD17Comment($statements, $customer)
    {
        $output = '';
        $h43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days'];
        $h44 = $statements[1]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days'];
        $h45 = $statements[2]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days'];
        $h32 = $customer->name; //to be check with jonathan
        $bj17 = 10;

        if ($h43 == "" && (($h45-$h44)/$h44 > 0)) {
            if (($h45-$h44)/$h44 > ($bj17)) {
                $number1 = abs(round(($h45-$h44)/$h44*100, 2));
                $output = __("Overall trade receivables reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            } else {
                $number1 = abs(round(($h45-$h44)/$h44*100, 2));
                $output = __("Overall trade receivables reflected a slightly increasing trend by :number1% over the years.", ['number1' => $number1]);
            }
        } else {
            if ($h32 == "" && (($h45-$h44)/$h44 < 0)) {
                if (($h45-$h44)/$h44 < (-$bj17)) {
                    $number1 = abs(round(($h45-$h44)/$h44*100, 2));
                    $output = __("Overall trade receivables has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($h45-$h44)/$h44*100, 2));
                    $output = __("Overall trade receivables has seen a marginal decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($h45 > $h44) {
                    $number1 = abs(round(($h45-$h44)/$h44*100, 2));
                    $output = __("Experienced a year on year increase by :number1% from the recent year to the previous year.", ['number1' => $number1]);
                } else {
                    $number1 = $h44 != 0 ? abs(round(($h45-$h44)/$h44*100, 2)) : 0;
                    $output = __("Experienced a year on year decrease by :number1% from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE17 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE17Comment($statements)
    {
        $output = '';
        $h43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days'];
        $h44 = $statements[1]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_receivable_turnover_days'];
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];
        $bk17 = 10;

        if ($h43 == '') {
            $output = '';
        } else {
            if (($h44-$h43) > 0) {
                if (($h44-$h43) > ($bk17)) {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = abs(round(($h44-$h43)*100, 2));
                    $output = __("Records have also indicated that from :item1 to :item2, receivables saw a significant year on year increase by :number1%.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = abs(round(($h44-$h43)*100, 2));
                    $output = __("Records have also indicated that from :item1 to :item2, receivables saw a year on year increase by :number1%.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            } else {
                if (($h44-$h43) < 0) {
                    if (($h44-$h43) < (-$bk17)) {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = abs(round(($h44-$h43)*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, receivables saw a significant year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    } else {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = abs(round(($h44-$h43)*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, receivables saw a year on year decrease by :number1%.", [
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


    /**
     * Retrieve BF18 formula.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBF18Comment($statements)
    {
        $comment = [];

        $ai43 = self::getAI43Comment($statements);
        $bc18 = collect($statements)->count() == 3 ? self::getBC18Comment($statements) : "";
        $bd18 = collect($statements)->count() == 3 ? self::getBD18Comment($statements) : "";
        $be18 = collect($statements)->count() == 2 ? self::getBE18Comment($statements) : "";

        if ($ai43 == "") {
            $comment[] = $bd18;
        } else {
            if ($bc18 == "") {
                $comment[] = "";
            } else {
                $comment[] = $bc18;
            }
        }

        if($bd18 == "") {
            $comment[] = "";
        } else {
            $comment[] = $bd18;
        }

        if($be18 == "") {
            $comment[] = "";
        } else {
            $comment[] = $be18;
        }

        return $comment;
    }

    /**
     * Retrieve BC18 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC18Comment($statements)
    {
        $output = '';
        $l43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days'];
        $l45 = $statements[2]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days'];
        $bi18 = 0.3;


        if ($l43 == '') {
            $output = '';
        } else {
            if (($l45-$l43)/$l43 > 0) {
                if (($l45-$l43)/$l43 > $bi18) {
                    $output = __("Overall trade payables recorded significant improvement over the 3 years.");
                } else {
                    $output = __("Overall trade payables recorded an improvement over the 3 years.");
                }
            } else {
                if (($l45-$l43)/$l43 < (-$bi18)) {
                    $output = __("Overall trade payables has seen a significant downward trend over the years.");
                } else {
                    $output = __("Overall trade payables has seen a drop over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD18 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD18Comment($statements)
    {
        $output = '';

        $bj18 = 10;
        $l43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days'];
        $l44 = $statements[1]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days'];
        $l45 = $statements[2]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days'];

        if ($l43 == '' && (($l45-$l44) > 0)) {
            if (($l45-$l44) > $bj18) {
                $number1 = round(($l45-$l44)/$l44*100, 2);
                $output = __("Overall trade payables reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            } else {
                $number1 = round(($l45-$l44)/$l44*100, 2);
                $output = __("Overall trade payables reflected a slightly increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($l43 == '' && (($l45-$l44) < 0)) {
                if (($l45-$l44) < (-$bj18)) {
                    $number1 = round(($l45-$l44)/$l44*100, 2);
                    $output = __("Overall trade payables has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $number1 = round(($l45-$l44)/$l44*100, 2);
                    $output = __("Experienced a year on year decrease by :number1% from the recent year to the previous year.", ['number1' => $number1]);
                }
            }

        }

        return $output;
    }

    /**
     * Retrieve BE18 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE18Comment($statements)
    {
        $output = '';
        $l43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days'];
        $l44 = $statements[1]['metadataResults']['ratioAnalysis']['efficiency']['avg_trade_payable_turnover_days'];
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];

        if ($l43 == '') {
            $output = '';
        } else {
            if (($l44-$l43) > 0) {
                if (($l44-$l43) > 10) {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = round(($l44-$l43)/$l43*100, 2);
                    $output = __("Records have also indicated that from :item1 to :item2, payables saw a significant year on year increase by :number1%.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = round(($l44-$l43)/$l43*100, 2);
                    $output = __("Records have also indicated that from :item1 to :item2, payables saw a year on year increase by :number1%.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            } else {
                if (($l44-$l43) < 0) {
                    if (($l44-$l43) < (-10)) {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = round(($l44-$l43)/$l43*100, 2);
                        $output = __("Records have also indicated that from :item1 to :item2, payables saw a significant year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    } else {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = round(($l44-$l43)/$l43*100, 2);
                        $output = __("Records have also indicated that from :item1 to :item2, payables saw a year on year decrease by :number1%.", [
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


    /**
     * Retrieve BF19 formula.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBF19Comment($statements)
    {
        $comment = [];
        $ai43 = self::getAI43Comment($statements);
        $bc19 = collect($statements)->count() == 3  ? self::getBC19Comment($statements) : "";
        $bd19 = collect($statements)->count() == 3  ? self::getBD19Comment($statements) : "";
        $be19 = collect($statements)->count() == 2  ? self::getBE19Comment($statements) : "";

        if ($ai43 == '') {
            $comment[] = '';
        } else {
            if ($bc19 == '') {
                $comment[] = '';
            } else {
                $comment[] = $bc19;
            }
        }

        if ($bd19 == '') {
            $comment[] = '';
        } else {
            $comment[] = $bd19;
        }

        if ($be19 == '') {
            $comment[] = '';
        } else {
            $comment[] = $be19;
        }

        return $comment;
    }

    /**
     * Retrieve BC19 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC19Comment($statements)
    {
        $output = '';

        $p43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'];
        $p45 = $statements[1]['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'];
        $bi19 = 0.3;

        if ($p43 == "") {
            $output = "";
        } else {
            if (($p45-$p43) / $p43 > 0) {
                if (($p45-$p43)/$p43 > ($bi19)) {
                    $output = __("Overall asset turnover recorded significant improvement over the 3 years.");
                } else {
                    $output = __("Overall asset turnover recorded an improvement over the 3 years.");
                }
            } else {
                if (($p45-$p43)/$p43 < (-$bi19)) {
                    $output = __("Overall asset turnover has seen a significant downward trend over the years.");
                } else {
                    $output = __("Overall asset turnover has seen a drop over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD19 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD19Comment($statements)
    {
        $output = '';
        $p43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'];
        $p44 = $statements[1]['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'];
        $p45 = $statements[2]['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'];
        $bj19 = 5;

        if ($p43 == "" && (($p45-$p44) > 0)) {
            if (($p45-$p44) > ($bj19)) {
                $number1 = abs(round(($p45-$p44)/$p44*100, 2));
                $output = __("Overall asset turnover reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            } else {
                $number1 = abs(round(($p45-$p44)/$p44*100, 2));
                $output = __("Overall asset turnover reflected an increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($p43 == "" && (($p45-$p44) < 0)) {
                if (($p45-$p44) < (-$bj19)) {
                    $number1 = abs(round(($p45-$p44)/$p44*100, 2));
                    $output = __("Overall asset turnover has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($p45-$p44)/$p44*100, 2));
                    $output = __("Overall asset turnover has seen a decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($p45 > $p44) {
                    $number1 = abs(round(($p45-$p44)/$p44*100, 2));
                    $output = __("An increase of :number1% was recorded from the recent year to the previous year.", ['number1' => $number1]);
                } else {
                    $number1 = $p44 != 0 ? abs(round(($p45-$p44)/$p44*100, 2)) : 0;
                    $output = __(" decrease of :number1% was recorded from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE19 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE19Comment($statements)
    {
        $output = '';
        $p43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'];
        $p44 = $statements[1]['metadataResults']['ratioAnalysis']['efficiency']['assets_turnover_ratio'];
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];
        $bk19 = 5;

        if ($p43 == '') {
            $output = '';
        } else {
            if (($p44-$p43) > 0) {
                if (($p44-$p43) > ($bk19)) {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = abs(round(($p44-$p43)/$p43*100, 2));
                    $output = __("Records have also indicated that from :item1 to :item2, asset turnover saw a significant year on year increase by :number1%.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = abs(round(($p44-$p43)/$p43*100, 2));
                    $output = __("Records have also indicated that from :item1 to :item2, asset turnover saw a year on year increase by :number1%.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            } else {
                if (($p44-$p43) < 0) {
                    if (($p44-$p43) < (-$bk19)) {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = abs(round(($p44-$p43)/$p43*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, asset turnover saw a significant year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    } else {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = abs(round(($p44-$p43)/$p43*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, asset turnover saw a year on year decrease by :number1%.", [
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


    /**
     * Retrieve BF20 formula.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBF20Comment($statements)
    {
        $comment = [];
        $ai43 = self::getAI43Comment($statements);
        $bc20 = collect($statements)->count() == 3 ? self::getBC20Comment($statements) : "";
        $bd20 = collect($statements)->count() == 3 ? self::getBD20Comment($statements) : "";
        $be20 = collect($statements)->count() == 2 ? self::getBE20Comment($statements) : "";

        if ($ai43 == '') {
            $comment[] = $bd20;
        } else {
            if ($bc20 == '') {
                $comment[] = '';
            } else {
                $comment[] = $bc20;
            }
        }

        if ($bd20 == '') {
            $comment[] = '';
        } else {
            $comment[] = $bd20;
        }

        if ($be20 == '') {
            $comment[] = '';
        } else {
            $comment[] = $be20;
        }

        return $comment;
    }

    /**
     * Retrieve BC20 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC20Comment($statements)
    {
        $output = '';
        $t43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'];
        $t45 = $statements[2]['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'];
        $bi20 = 0.3;

        if ($t43 == '') {
            $output = '';
        } else {
            if (($t45-$t43)/$t43 > 0) {
                if (($t45-$t43)/$t43 > $bi20) {
                    $output = __("Overall inventory turnover recorded significant improvement over the 3 years.");
                } else {
                    $output = __("Overall inventory turnover recorded an improvement over the 3 years.");
                }
            } else {
                if (($t45-$t43)/$t43< (-$bi20)) {
                    $output = __("Overall inventory turnover has seen a significant downward trend over the years.");
                } else {
                    $output = __("Overall inventory turnover has seen a drop over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD20 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD20Comment($statements)
    {
        $output = '';

        $t43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'];
        $t44 = $statements[1]['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'];
        $t45 = $statements[2]['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'];
        $bj20 = 5;
        $q32 = ':: FINANCIAL ANALYSIS REPORT ::';

        if ($t43 == '' && (($t45-$t44) > 0)) {
            if (($t45-$t44) > $bj20) {
                $number1 = abs(round(($t45-$t44)/$t44*100, 2));
                $output = __("Overall inventory turnover reflected a significant improvement trend, increasing by :number1%.", ['number1' => $number1]);
            } else {
                $number1 = abs(round(($t45-$t44)/$t44*100, 2));
                $output = __("Overall inventory turnover reflected improvements, increasing by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($q32 == '' && ($t45-$t44) < 0) {
                if (($t45-$t44) < (-$bj20)) {
                    $number1 = abs(round(($t45-$t44)/$t44*100, 2));
                    $output = __("Overall inventory turnover has seen a significant dip in demand, declining by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($t45-$t44)/$t44*100, 2));
                    $output = __("Overall dip in demand has seen inventory turnover decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($t45 > $t44) {
                    $number1 = abs(round(($t45-$t44)/$t44*100, 2));
                    $output = __("A :number1% increase was observed from the recent year to the previous year.", ['number1' => $number1]);
                } else {
                    $number1 = $t44 != 0 ? abs(round(($t45-$t44)/$t44*100, 2)) : 0;
                    $output = __("A :number1% decrease from the recent year to the previous year was observed.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE20 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE20Comment($statements)
    {
        $output = '';
        $t43 = $statements[0]['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'];
        $t44 = $statements[1]['metadataResults']['ratioAnalysis']['efficiency']['inventory_turnover_ratio'];
        $bk20 = 5;

        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];

        if ($t43 == '') {
            $output = '';
        } else {
            if (($t44-$t43) > 0) {
                if (($t44-$t43) > ($bk20)) {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = abs(round(($t44-$t43)/$t43*100, 2));
                    $output = __("Records have also indicated that from :item1 to :item2, inventory turnover saw a significant year on year increase by :number1%.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $item1 = $d19;
                    $item2 = $d20;
                    $number1 = abs(round(($t44-$t43)/$t43*100, 2));
                    $output = __("Records have also indicated that from :item1 to :item2, inventory turnover saw a year on year decrease by :number1%.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                }
            } else {
                if (($t44-$t43) < 0) {
                    if (($t44-$t43) < (-$bk20)) {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = abs(round(($t44-$t43)/$t43*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, inventory turnover saw a significant year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    } else {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = abs(round(($t44-$t43)/$t43*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, inventory turnover saw a year on year decrease by :number1%.", [
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
