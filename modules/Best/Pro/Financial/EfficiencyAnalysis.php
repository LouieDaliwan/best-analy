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
            'charts' => [
                'labels' => collect(
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H42:W42')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    // Year 1.
                    [
                        'label' => $year1,
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H43:W43')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'bg' => '#a2d5ac',
                        'backgroundColor' => ['#a2d5ac', '#a2d5ac'],
                    ],
                    // Year 2.
                    [
                        'label' => $year2,
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H44:W44')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'bg' => '#3aada8',
                        'backgroundColor' => ['#3aada8', '#3aada8'],
                    ],
                    // Year 3.
                    [
                        'label' => $year3,
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('H45:W45')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'bg' => '#557c83',
                        'backgroundColor' => ['#557c83', '#557c83'],
                    ],
                ],
            ],

            'comments' => [
                self::getBF17Comment($spreadsheet),
                self::getBF18Comment($spreadsheet),
                self::getBF19Comment($spreadsheet),
                self::getBF20Comment($spreadsheet),
            ],
        ];
    }

    /**
     * Retrieve BF17 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF17Comment($spreadsheet)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp);
        $bc17 = self::getBC17Comment($sp);
        $bd17 = self::getBD17Comment($sp);
        $be17 = self::getBE17Comment($sp);

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getAI43Comment($spreadsheet)
    {
        return $spreadsheet->getCell('AI43')->getCalculatedValue();
    }

    /**
     * Retrieve BC17 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC17Comment($spreadsheet)
    {
        $output = '';

        $h43 = $spreadsheet->getCell('H43')->getCalculatedValue();
        $h45 = $spreadsheet->getCell('H45')->getCalculatedValue() ?: 0;
        $bi17 = $spreadsheet->getCell('BI17')->getCalculatedValue() ?: 0;

        if ($h43 == "") {
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD17Comment($spreadsheet)
    {
        $output = '';
        $h43 = $spreadsheet->getCell('H43')->getCalculatedValue();
        $h32 = $spreadsheet->getCell('H32')->getCalculatedValue();
        $h44 = $spreadsheet->getCell('H44')->getCalculatedValue() ?: 1;
        $h45 = $spreadsheet->getCell('H45')->getCalculatedValue() ?: 0;
        $bj17 = $spreadsheet->getCell('BJ17')->getCalculatedValue() ?: 0;

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
                    $number1 = abs(round(($h45-$h44)/$h44*100, 2));
                    $output = __("Experienced a year on year decrease by :number1% from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE17 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE17Comment($spreadsheet)
    {
        $output = '';
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue() ?: 0;
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue() ?: 0;
        $h43 = $spreadsheet->getCell('H43')->getCalculatedValue();
        $h44 = $spreadsheet->getCell('H44')->getCalculatedValue() ?: 0;
        $bk17 = $spreadsheet->getCell('BK17')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF18Comment($spreadsheet)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp);
        $bc18 = self::getBC18Comment($sp);
        $bd18 = self::getBD18Comment($sp);
        $be18 = self::getBE18Comment($sp);

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC18Comment($spreadsheet)
    {
        $output = '';
        $l43 = $spreadsheet->getCell('L43')->getCalculatedValue();
        $bi18 = $spreadsheet->getCell('BI18')->getCalculatedValue() ?: 0;
        $l43 = $spreadsheet->getCell('L43')->getCalculatedValue() ?: 1;
        $l45 = $spreadsheet->getCell('L45')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD18Comment($spreadsheet)
    {
        $output = '';

        $bj18 = $spreadsheet->getCell('BJ18')->getCalculatedValue();
        $l43 = $spreadsheet->getCell('L43')->getCalculatedValue();
        $l44 = $spreadsheet->getCell('L44')->getCalculatedValue() ?: 1;
        $l45 = $spreadsheet->getCell('L45')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE18Comment($spreadsheet)
    {
        $output = '';
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue() ?: 0;
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue() ?: 0;
        $l43 = $spreadsheet->getCell('L43')->getCalculatedValue();
        $l44 = $spreadsheet->getCell('L44')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF19Comment($spreadsheet)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp);
        $bc19 = self::getBC19Comment($sp);
        $bd19 = self::getBD19Comment($sp);
        $be19 = self::getBE19Comment($sp);

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC19Comment($spreadsheet)
    {
        $output = '';
        $p43 = $spreadsheet->getCell('P43')->getCalculatedValue();
        $p45 = $spreadsheet->getCell('P45')->getCalculatedValue() ?: 0;
        $bi19 = $spreadsheet->getCell('BI19')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD19Comment($spreadsheet)
    {
        $output = '';
        $p43 = $spreadsheet->getCell('P43')->getCalculatedValue();
        $p44 = $spreadsheet->getCell('P44')->getCalculatedValue() ?: 1;
        $p45 = $spreadsheet->getCell('P45')->getCalculatedValue() ?: 0;
        $bj19 = $spreadsheet->getCell('BJ19')->getCalculatedValue() ?: 0;

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
                    $number1 = abs(round(($p45-$p44)/$p44*100, 2));
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
    public static function getBE19Comment($spreadsheet)
    {
        $output = '';
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue() ?: 0;
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue() ?: 0;
        $p43 = $spreadsheet->getCell('P43')->getCalculatedValue();
        $p44 = $spreadsheet->getCell('P44')->getCalculatedValue() ?: 0;
        $bk19 = $spreadsheet->getCell('BK19')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBF20Comment($spreadsheet)
    {
        $comment = [];
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $ai43 = self::getAI43Comment($sp);
        $bc20 = self::getBC20Comment($sp);
        $bd20 = self::getBD20Comment($sp);
        $be20 = self::getBE20Comment($sp);

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC20Comment($spreadsheet)
    {
        $output = '';
        $bi20 = $spreadsheet->getCell('BI20')->getCalculatedValue() ?: 0;
        $t43 = $spreadsheet->getCell('T43')->getCalculatedValue();
        $t45 = $spreadsheet->getCell('T45')->getCalculatedValue() ?: 0;

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD20Comment($spreadsheet)
    {
        $output = '';
        $bj20 = $spreadsheet->getCell('BJ20')->getCalculatedValue() ?: 0;
        $q32 = $spreadsheet->getCell('Q32')->getCalculatedValue();
        $t43 = $spreadsheet->getCell('T43')->getCalculatedValue();
        $t44 = $spreadsheet->getCell('T44')->getCalculatedValue() ?: 1;
        $t45 = $spreadsheet->getCell('T45')->getCalculatedValue() ?: 0;

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
                    $number1 = abs(round(($t45-$t44)/$t44*100, 2));
                    $output = __("A :number1% decrease from the recent year to the previous year was observed.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE20 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE20Comment($spreadsheet)
    {
        $output = '';
        $bk20 = $spreadsheet->getCell('bk20')->getCalculatedValue() ?: 0;
        $d19 = $spreadsheet->getCell('d19')->getCalculatedValue() ?: 0;
        $d20 = $spreadsheet->getCell('d20')->getCalculatedValue() ?: 0;
        $t43 = $spreadsheet->getCell('t43')->getCalculatedValue();
        $t44 = $spreadsheet->getCell('t44')->getCalculatedValue() ?: 0;

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
