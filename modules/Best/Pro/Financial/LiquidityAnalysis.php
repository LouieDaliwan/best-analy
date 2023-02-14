<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;

/**
 * Analysis class for BEST formulas.
 *
 * @phpcs:disable
 */
abstract class LiquidityAnalysis extends AbstractAnalysis
{
    /**
     * Retrieve the report.
     * @param   \Customer\Models\FinancialStatement $statements
     * @param   \Customer\Models\Customer           $customer
     * @return array
     */
    public static function getReport($statements, $customer)
    {
        $labels = ['Current Ratio', 'Cash Ratio', 'Working K to Total Assets'];

        return [
            'chart' => [
                'labels' => $labels,
                'dataset' => self::formatDataSet($statements),
            ],

            'comments' => [
                array_filter(self::getBF12Formula($statements, $customer)),
                array_filter(self::getBF13Formula($statements)),
                array_filter(self::getBF14Formula($statements)),
            ],
        ];
    }

    protected static function formatDataSet($statements)
    {
        $data = [];

        $ratios = ['current_ratio', 'cash_ratio', 'working_capital_turnover'];

        foreach ($statements as $statement) {

            $tempData = [];

            $liquidity = $statement['metadataResults']['ratioAnalysis']['liquidity'];

            foreach ($ratios as $item) {
                $value = $item == ('current_ratio' || 'cash_ratio' ) ? (float) str_replace(':1', "", $liquidity[$item]): $liquidity[$item];
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
                'backgroundColor' => [$bgColor, $bgColor, $bgColor, $bgColor, $bgColor, $bgColor],
            ];

            $count++;
        }

        return $dataSet;
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
     * Retrieve BF12 formula.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @param  \Customer\Models\Customer           $customer
     * @return array
     */
    public static function getBF12Formula($statements, $customer)
    {
        $comment = [];
        $ai43 = self::getAI43Comment($statements);
        $be12 = collect($statements)->count() == 2 ? self::getBE12Comment($statements) : "";
        $bc12 = collect($statements)->count() == 3 ? self::getBC12Comment($statements) : "";
        $bd12 = collect($statements)->count() == 3 ? self::getBD12Comment($statements, $customer) : "";

        if ($ai43 == '') {
            $comment[] = $bd12;
        } else {
            if ($bc12 == '') {
                $comment[] = '';
            } else {
                $comment[] = $bc12;
            }
        }

        if ($bd12 == '') {
            $comment[] = '';
        } else {
            $comment[] = $bd12;
        }

        if ($be12 == '') {
            $comment[] = '';
        } else {
            $comment[] = $be12;
        }

        return $comment;
    }

    /**
     * Retrieve BE12 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE12Comment($statements)
    {
        $output = '';
        $ai19 = (float) str_replace(":1", "", $statements[0]['metadataResults']['ratioAnalysis']['liquidity']['current_ratio']);
        $ai20 = (float) str_replace(":1", "", $statements[1]['metadataResults']['ratioAnalysis']['liquidity']['current_ratio']);
        $bk12 = 0.5;
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];

        if (($ai20-$ai19) > 0) {
            if (($ai20-$ai19) > $bk12) {
                $item1 = $d19;
                $item2 = $d20;
                if($ai19 != 0) {
                    $number1 = abs(round(($ai20-$ai19)/$ai19*100, 2));
                } else {
                    $number1 = 0;
                }
                // $number1 = abs(round(($ai20-$ai19)/$ai19*100, 2));
                $output = __("Records have also shown that current ratio saw a significant year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            } else {
                $item1 = $d19;
                $item2 = $d20;

                if($ai19 != 0) {
                    $number1 = abs(round(($ai20-$ai19)/$ai19*100, 2));
                } else {
                    $number1 = 0;
                }

                // $number1 = abs(round(($ai20-$ai19)/$ai19*100, 2));
                $output = __("Records have also shown that current ratio saw a year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            }
        } else {
            if (($ai20-$ai19) < 0) {
                $item1 = $d19;
                $item2 = $d20;

                if($ai19 != 0) {
                    $number1 = abs(round(($ai20-$ai19)/$ai19*100, 2));
                } else {
                    $number1 = 0;
                }
                // $number1 = abs(round(($ai20-$ai19)/$ai19*100, 2));
                if (($ai20-$ai19) < (-$bk12)) {
                    $output = __("Records have also shown that current ratio saw a significant year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $output = __("Records have also shown that current ratio saw a year on year decrease by :number1% from :item1 to :item2.", [
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
     * Retrieve BC12 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC12Comment($statements)
    {
        $output = '';
        $ai19 = (float) str_replace(":1", "", $statements[0]['metadataResults']['ratioAnalysis']['liquidity']['current_ratio']);
        $ai21 = (float) str_replace(":1", "", $statements[2]['metadataResults']['ratioAnalysis']['liquidity']['current_ratio']);
        $bi12 = 0.3;

        if ($ai19 == "") {
            $output = "";
        } else {
            if (($ai21-$ai19)/$ai19 > 0) {
                if (($ai21-$ai19)/$ai19>$bi12) {
                    $output = __("Overall current ratio recorded significant improvement over the 3 years.");
                } else {
                    $output = __("Overall current ratio recorded an improvement over the 3 years.");
                }
            } else {
                if (($ai21-$ai19)/$ai19< (-$bi12)) {
                    $output = __("Overall current ratio has seen a significant downward trend over the years.");
                } else {
                    $output = __("Overall current ratio has seen a drop over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD12 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @param  \Customer\Models\Customer           $customerData
     * @return array
     */
    public static function getBD12Comment($statements, $customerData)
    {
        $output = '';
        $customer = $customerData->name;
        $ai19 = (float) str_replace(":1", "", $statements[0]['metadataResults']['ratioAnalysis']['liquidity']['current_ratio']);
        $ai20 = (float) str_replace(":1", "", $statements[1]['metadataResults']['ratioAnalysis']['liquidity']['current_ratio']);
        $ai21 = (float) str_replace(":1", "", $statements[2]['metadataResults']['ratioAnalysis']['liquidity']['current_ratio']);
        $bj12 = 0.5;

        if ($ai19 == "" && ($ai21-$ai20) > 0) {
            if (($ai21-$ai20)>$bj12) {
                if($ai20 != 0 && $ai21-$ai20 != 0) {
                    $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                } else {
                    $number1 = 0;
                }
                // $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                $output = __("Overall current ratio reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            } else {
                if($ai20 != 0 && $ai21-$ai20 != 0) {
                    $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                } else {
                    $number1 = 0;
                }

                // $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                $output = __("Overall current ratio reflected an increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if($ai19 == "" && ($ai21-$ai20) < 0) {
                if (($ai21-$ai20) < (-$bj12)) {
                    if($ai20 != 0) {
                        $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                    } else {
                        $number1 = 0;
                    }
                    // $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                    $output = __("Overall current ratio has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $number1 = $ai20 != 0 ? abs(round(($ai21-$ai20)/$ai20*100, 2)) : 0;
                    $output = __("Overall current ratio has seen a decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if($ai21 > $ai20) {
                    if($ai20 != 0) {
                        $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                    } else {
                        $number1 = 0;
                    }
                    // $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                    $output = __(":customer experienced a year on year increase by :number1% from the recent year to the previous year.", [
                        'customer' => $customer,
                        'number1' => $number1,
                    ]);
                } else {
                    $number1 = $ai20 != 0 ? abs(round(($ai21-$ai20)/$ai20*100, 2)) : 0;
                    $output = __(":customer experienced a year on year decrease by :number1% from the recent year to the previous year.", [
                        'customer' => $customer,
                        'number1' => $number1,
                    ]);
                }
            }
        }

        return $output;
    }


    /**
     * Retrieve BF13 formula.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBF13Formula($statements)
    {
        $comment = [];

        $ai43 = self::getAI43Comment($statements);
        $bc13 = collect($statements)->count() == 3 ? self::getBC13Comment($statements) : "";
        $bd13 = collect($statements)->count() == 3 ? self::getBD13Comment($statements) : "";
        $be13 = collect($statements)->count() == 2 ? self::getBE13Comment($statements) : "";

        if ($ai43 == "") {
            $comment[] = $bd13;
        } else {
            if ($bc13 == "") {
                $comment[] = "";
            } else {
                $comment[] = $bc13;
            }
        }

        if ($bd13 == "") {
            $comment[] = "";
        } else {
            $comment[] = $bd13;
        }

        if ($be13 == "") {
            $comment[] = "";
        } else {
            $comment[] = $be13;
        }

        return $comment;
    }

    /**
     * Retrieve BC13 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC13Comment($statements)
    {
        $output = '';
        $am19 = (float) str_replace(":1", "", $statements[0]['metadataResults']['ratioAnalysis']['liquidity']['cash_ratio']);
        $am21 = (float) str_replace(":1", "", $statements[2]['metadataResults']['ratioAnalysis']['liquidity']['cash_ratio']);

        $bi13 = 0.3;

        if ($am19 == "") {
            $output = "";
        } else {
            if (($am21-$am19)/$am19 > 0) {
                if (($am21-$am19)/$am19 > $bi13) {
                    $output = __("Overall cash ratio reflected a significant uptrend.");
                } else {
                    $output = __("Overall operating margin reflected an uptrend.");
                }
            } else {
                if (($am21-$am19)/$am19 < (-$bi13)) {
                    $output = __("Overall cash ratio has seen a significant downtrend over the years.");
                } else {
                    $output = __("Overall cash ratio has seen a downtrend over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD13 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD13Comment($statements)
    {
        $output = '';
        $am19 = (float) str_replace(":1", "", $statements[0]['metadataResults']['ratioAnalysis']['liquidity']['cash_ratio']);
        $am20 = (float) str_replace(":1", "", $statements[1]['metadataResults']['ratioAnalysis']['liquidity']['cash_ratio']);
        $am21 = (float) str_replace(":1", "", $statements[2]['metadataResults']['ratioAnalysis']['liquidity']['cash_ratio']);

        $bj13 = 1;

        if ($am19 == "" && ($am21-$am20) > 0) {
            if (($am21-$am20) > $bj13) {
                $number1 = abs(round(($am21-$am20)/$am20*100, 2));
                $output = __("Overall cash ratio margin reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            } else {
                $number1 = abs(round(($am21-$am20)/$am20*100, 2));
                $output = __("Overall cash ratio reflected an increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($am19 == "" && ($am21-$am20) < 0) {
                if (($am21-$am20) < (-$bj13)) {
                    $number1 = abs(round(($am21-$am20)/$am20*100, 2));
                    $output = __("Overall cash ratio has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($am21-$am20)/$am20*100, 2));
                    $output = __("Overall cash ratio has seen a decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($am21-$am20>0) {
                    $number1 = abs(round(($am21-$am20)/$am20*100, 2));
                    $output = __("Year on year increase of :number1% was recorded from the recent year to the previous year.", ['number1' => $number1]);
                } else {
                    $number1 = $am20 != 0 ? abs(round(($am21-$am20)/$am20*100, 2)) : 0;
                    $output = __("Year on year decrease by :number1% was recorded from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE13 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE13Comment($statements)
    {
        $output = '';

        $am19 = (float) str_replace(":1", "", $statements[0]['metadataResults']['ratioAnalysis']['liquidity']['cash_ratio']);
        $am20 = (float) str_replace(":1", "", $statements[1]['metadataResults']['ratioAnalysis']['liquidity']['cash_ratio']);

        $bk13 = 0.5;
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];
        $item1 = $d19;
        $item2 = $d20;
        $number1 = abs(round(($am20-$am19)/$am19*100, 2));

        if (($am20-$am19)>0) {
            if (($am20-$am19)>$bk13) {
                $output = __("Records have also shown that cash ratio saw a significant year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            } else {
                $output = __("Records have also shown that cash ratio experienced a year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            }
        } else {
            if(($am20-$am19)<0) {
                if(($am20-$am19) < (-$bk13)) {
                    $output = __("Records have also shown that cash ratio experienced a significant year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $output = __("Records have also shown that cash ratio experienced a year on year decrease by :number1% from :item1 to :item2.", [
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
     * Retrieve BF14 formula.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBF14Formula($statements)
    {
        $comment = [];

        $ai43 = self::getAI43Comment($statements);
        $bc14 = collect($statements)->count() == 3 ? self::getBC14Comment($statements) : "";
        $bd14 = collect($statements)->count() == 3 ? self::getBD14Comment($statements) : "";
        $be14 = collect($statements)->count() == 2 ? self::getBE14Comment($statements) : "";

        if ($ai43 == "") {
            $comment[] = $bd14;
        } else {
            if ($bc14 == "") {
                $comment[] = "";
            } else {
                $comment[] = $bc14;
            }
        }

        $comment[] = $bd14;
        $comment[] = $be14;

        return $comment;
    }

    /**
     * Retrieve BC14 comment.
     *
     * @param  \Customer\Models\FinancialStatement $customer
     * @return array
     */
    public static function getBC14Comment($statements)
    {
        $output = '';

        $aq19 = (float) str_replace(":1", "", $statements[0]['metadataResults']['ratioAnalysis']['liquidity']['working_capital_turnover']);
        $aq21 = (float) str_replace(":1", "", $statements[2]['metadataResults']['ratioAnalysis']['liquidity']['working_capital_turnover']);

        $bi14 = 0.3;

        if($aq19 == "") {
            $output = "";
        } else {
            if(($aq21-$aq19)/$aq19>0) {
                if(($aq21-$aq19)/$aq19>$bi14) {
                    $output = __("Overall working capital has shown positive trend over the 3 years.");
                } else {
                    $output = __("Overall working capital has shown positive trend over the 3 years.");
                }
            } else {
                if (($aq21-$aq19)/$aq19 < (-$bi14)) {
                    $output = __("Overall working capital has seen a significant slide over the years.");
                } else {
                    $output = __("Overall working capital has seen a slide over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD14 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD14Comment($statements)
    {
        $output = '';
        $aq19 = (float) str_replace(":1", "", $statements[0]['metadataResults']['ratioAnalysis']['liquidity']['working_capital_turnover']);
        $aq20 = (float) str_replace(":1", "", $statements[1]['metadataResults']['ratioAnalysis']['liquidity']['working_capital_turnover']);
        $aq21 = (float) str_replace(":1", "", $statements[2]['metadataResults']['ratioAnalysis']['liquidity']['working_capital_turnover']);
        $bj14 = 8;

        $number1 = $aq20 != 0 ? abs(round(($aq21-$aq20)/$aq20*100, 2)) : 0;
        if ($aq19 == "" && ($aq21-$aq20) > 0) {
            if (($aq21-$aq20) > $bj14) {
                $output = __("Overall, the working capital turnover reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            } else {
                $output = __("Overall, the working capital turnover reflected an increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($aq19 == "" && ($aq21-$aq20) < 0) {
                if (($aq21-$aq20) < (-$bj14)) {
                    $output = __("Overall, the working capital turnover has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $output = __("Overall, the working capital turnover has seen a decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($aq21-$aq20 > 0) {
                    $output = __("An improvement of :number1% was achieved from the recent year to the previous year.", ['number1' => $number1]);
                } else {
                    $output = __("A decline by :number1% was observed from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE14 comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE14Comment($statements)
    {
        $output = '';
        $aq19 = (float) str_replace(":1", "", $statements[0]['metadataResults']['ratioAnalysis']['liquidity']['working_capital_turnover']);
        $aq20 = (float) str_replace(":1", "", $statements[1]['metadataResults']['ratioAnalysis']['liquidity']['working_capital_turnover']);
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];
        $n27 = 0;
        $n28 = 0;

        $bk14 = 8;

        $item1 = $d19;
        $item2 = $d20;
        $number1 = abs(round(($aq20-$aq19)/$aq19*100, 2));
        if (($aq20-$aq19) > 0) {
            if (($n28-$n27) > $bk14) {
                $output = __("Records have also indicated that the working capital turnover notched a significant year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            } else {
                $output = __("Records have also indicated that the working capital turnover notched a year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            }
        } else {
            if (($aq20-$aq19) < 0) {
                if (($aq20-$aq19) < (-$bk14)) {
                    $output = __("Records have also indicated that the working capital turnover notched a significant year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $output = __("Records have also indicated that the working capital turnover notched a year on year decrease by :number1% from :item1 to :item2.", [
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
