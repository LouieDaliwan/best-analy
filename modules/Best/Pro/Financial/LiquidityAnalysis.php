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
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public static function getReport(Customer $customer)
    {
        $spreadsheet = self::getSpreadsheet($customer);

        $year1 = $spreadsheet->getSheetByName('FS_inputs')->getCell('AC8')->getCalculatedValue();
        $year2 = $spreadsheet->getSheetByName('FS_inputs')->getCell('AI8')->getCalculatedValue();
        $year3 = $spreadsheet->getSheetByName('FS_inputs')->getCell('AO8')->getCalculatedValue();

        return [
            'chart' => [
                'labels' => collect(
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI18:AU18')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    // Year 1.
                    [
                        'label' => $year1,
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI19:AU19')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#a2d5ac', '#a2d5ac'],
                    ],
                    // Year 2.
                    [
                        'label' => $year2,
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI20:AU20')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#3aada8', '#3aada8'],
                    ],
                    // Year 3.
                    [
                        'label' => $year3,
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI21:AU21')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#557c83', '#557c83'],
                    ],
                ],
            ],

            'comment' => [
                self::getBF12Formula($spreadsheet),
                self::getBF13Formula($spreadsheet),
                self::getBF14Formula($spreadsheet),
            ],
        ];
    }

    /**
     * Retrieve AI43 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getAI43Comment($spreadsheet)
    {
        return $spreadsheet->getCell('AI43')->getCalculatedValue();
    }

    /**
     * Retrieve BF12 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF12Formula($spreadsheet)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp);
        $be12 = self::getBE12Comment($sp);
        $bc12 = self::getBC12Comment($sp);
        $bd12 = self::getBD12Comment($sp, $spreadsheet);

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE12Comment($spreadsheet)
    {
        $output = '';
        $ai19 = $spreadsheet->getCell('AI19')->getCalculatedValue() ?: 1;
        $ai20 = $spreadsheet->getCell('AI20')->getCalculatedValue();
        $bk12 = $spreadsheet->getCell('BK12')->getCalculatedValue();
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue();
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue();

        if (($ai20-$ai19) > 0) {
            if (($ai20-$ai19) > $bk12) {
                $item1 = $d19;
                $item2 = $d20;
                $number1 = abs(round(($ai20-$ai19)/$ai19*100, 2));
                $output = __("Records have also shown that current ratio saw a significant year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            } else {
                $item1 = $d19;
                $item2 = $d20;
                $number1 = abs(round(($ai20-$ai19)/$ai19*100, 2));
                $output = __("Records have also shown that current ratio saw a year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            }
        } else {
            if (($ai20-$ai19) < 0) {
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC12Comment($spreadsheet)
    {
        $output = '';
        $ai19 = $spreadsheet->getCell('AI19')->getCalculatedValue() ?: 1;
        $ai21 = $spreadsheet->getCell('AI21')->getCalculatedValue();
        $bi12 = $spreadsheet->getCell('BI12')->getCalculatedValue();

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD12Comment($spreadsheet, $main)
    {
        $output = '';
        $customer = $main->getSheetByName('Customer')->getCell('B2')->getCalculatedValue();
        $ai19 = $spreadsheet->getCell('AI19')->getCalculatedValue();
        $ai20 = $spreadsheet->getCell('AI20')->getCalculatedValue() ?: 1;
        $ai21 = $spreadsheet->getCell('AI21')->getCalculatedValue();
        $bj12 = $spreadsheet->getCell('BJ12')->getCalculatedValue();

        if ($ai19 == "" && ($ai21-$ai20) > 0) {
            if (($ai21-$ai20)>$bj12) {
                $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                $output = __("Overall current ratio reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            } else {
                $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                $output = __("Overall current ratio reflected an increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if($ai19 == "" && ($ai21-$ai20) < 0) {
                if (($ai21-$ai20) < (-$bj12)) {
                    $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                    $output = __("Overall current ratio has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                    $output = __("Overall current ratio has seen a decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if($ai21 > $ai20) {
                    $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
                    $output = __(":customer experienced a year on year increase by :number1% from the recent year to the previous year.", [
                        'customer' => $customer,
                        'number1' => $number1,
                    ]);
                } else {
                    $number1 = abs(round(($ai21-$ai20)/$ai20*100, 2));
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF13Formula($spreadsheet)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');

        $ai43 = self::getAI43Comment($sp);
        $bc13 = self::getBC13Comment($sp);
        $bd13 = self::getBD13Comment($sp);
        $be13 = self::getBE13Comment($sp);

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC13Comment($spreadsheet)
    {
        $output = '';
        $am19 = $spreadsheet->getCell('AM19')->getCalculatedValue() ?: 1;
        $am21 = $spreadsheet->getCell('AM21')->getCalculatedValue();
        $bi13 = $spreadsheet->getCell('BI13')->getCalculatedValue();

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD13Comment($spreadsheet)
    {
        $output = '';
        $am19 = $spreadsheet->getCell('AM19')->getCalculatedValue();
        $am20 = $spreadsheet->getCell('AM20')->getCalculatedValue() ?: 1;
        $am21 = $spreadsheet->getCell('AM21')->getCalculatedValue();
        $bj13 = $spreadsheet->getCell('BJ13')->getCalculatedValue();

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
                    $number1 = abs(round(($am21-$am20)/$am20*100, 2));
                    $output = __("Year on year decrease by :number1% was recorded from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE13 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE13Comment($spreadsheet)
    {
        $output = '';

        $am19 = $spreadsheet->getCell('AM19')->getCalculatedValue() ?: 1;
        $am20 = $spreadsheet->getCell('AM20')->getCalculatedValue();
        $bk13 = $spreadsheet->getCell('BK13')->getCalculatedValue();
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue();
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue();
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF14Formula($spreadsheet)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp);
        $bc14 = self::getBC14Comment($sp);
        $bd14 = self::getBD14Comment($sp);
        $be14 = self::getBE14Comment($sp);

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC14Comment($spreadsheet)
    {
        $output = '';
        $aq19 = $spreadsheet->getCell('AQ19')->getCalculatedValue() ?: 1;
        $aq21 = $spreadsheet->getCell('AQ21')->getCalculatedValue();
        $bi14 = $spreadsheet->getCell('BI14')->getCalculatedValue();

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD14Comment($spreadsheet)
    {
        $output = '';
        $aq19 = $spreadsheet->getCell('AQ19')->getCalculatedValue();
        $aq20 = $spreadsheet->getCell('AQ20')->getCalculatedValue() ?: 1;
        $aq21 = $spreadsheet->getCell('AQ21')->getCalculatedValue();
        $bj14 = $spreadsheet->getCell('BJ14')->getCalculatedValue();

        $number1 = abs(round(($aq21-$aq20)/$aq20*100, 2));
        if ($aq19 == "" && ($aq21-$aq20) > 0) {
            if (($aq21-$aq20) > $bj14) {
                $output = __("Overall, the working capital to total assets reflected a significant increasing trend by :number1%.", ['number1' => $number1]);
            } else {
                $output = __("Overall, the working capital to total assets reflected an increasing trend by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($aq19 == "" && ($aq21-$aq20) < 0) {
                if (($aq21-$aq20) < (-$bj14)) {
                    $output = __("Overall, the working capital to total assets has seen a significant decline by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $output = __("Overall, the working capital to total assets has seen a decline by :number1% over the years.", ['number1' => $number1]);
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE14Comment($spreadsheet)
    {
        $output = '';
        $aq19 = $spreadsheet->getCell('AQ19')->getCalculatedValue() ?: 1;
        $aq20 = $spreadsheet->getCell('AQ20')->getCalculatedValue();
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue();
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue();
        $n27 = $spreadsheet->getCell('N27')->getCalculatedValue();
        $n28 = $spreadsheet->getCell('N28')->getCalculatedValue();
        $bk14 = $spreadsheet->getCell('BK14')->getCalculatedValue();

        $item1 = $d19;
        $item2 = $d20;
        $number1 = abs(round(($aq20-$aq19)/$aq19*100, 2));
        if (($aq20-$aq19) > 0) {
            if (($n28-$n27) > $bk14) {
                $output = __("Records have also indicated that the working capital to total assets notched a significant year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            } else {
                $output = __("Records have also indicated that the working capital to total assets notched a year on year increase by :number1% from :item1 to :item2.", [
                    'item1' => $item1,
                    'item2' => $item2,
                    'number1' => $number1,
                ]);
            }
        } else {
            if (($aq20-$aq19) < 0) {
                if (($aq20-$aq19) < (-$bk14)) {
                    $output = __("Records have also indicated that the working capital to total assets notched a significant year on year decrease by :number1% from :item1 to :item2.", [
                        'item1' => $item1,
                        'item2' => $item2,
                        'number1' => $number1,
                    ]);
                } else {
                    $output = __("Records have also indicated that the working capital to total assets notched a year on year decrease by :number1% from :item1 to :item2.", [
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
