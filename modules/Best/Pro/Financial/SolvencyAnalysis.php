<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;

/**
 * Analysis class for BEST formulas.
 *
 * @phpcs:disable
 */
abstract class SolvencyAnalysis extends AbstractAnalysis
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
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI42:AN42')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    // Year 1.
                    [
                        'label' => $year1,
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI43:AR43')
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
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI44:AR44')
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
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI45:AR45')
                        )->flatten()->reject(function ($cell) {
                            return is_null($cell);
                        })->map(function ($cell) {
                            return str_replace('%', '', $cell);
                        })->values()->toArray(),
                        'backgroundColor' => ['#557c83', '#557c83'],
                    ],
                ],
            ],

            'comments' => [
                self::getFirstComment($spreadsheet),
                self::getSecondComment($spreadsheet),
            ],
        ];
    }

    /**
     * Retrieve the first comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return string|array
     */
    public static function getFirstComment($spreadsheet)
    {
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');

        $ai43 = $sp->getCell('AI43')->getCalculatedValue();
        $bc24 = self::getBC24Comment($sp);
        $bd24 = self::getBD24Comment($sp);
        $be24 = self::getBE24Comment($sp);
        $comment = [];

        if ($ai43 == '') {
            $comment[] = $bd24;
        } else {
            if ($bc24 == '') {
                $comment[] = '';
            } else {
                $comment[] = $bc24;
            }
        }

        if ($bd24 == '') {
            $comment[] = '';
        } else {
            $comment[] = $bd24;
        }

        if ($be24 == '') {
            $comment[] = '';
        } else {
            $comment[] = $be24;
        }

        return $comment;
    }

    /**
     * Retrieve BC24 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC24Comment($spreadsheet)
    {
        $output = null;
        $ai43 = $spreadsheet->getCell('AI43')->getCalculatedValue();
        $ai44 = $spreadsheet->getCell('AI44')->getCalculatedValue();
        $ai45 = $spreadsheet->getCell('AI45')->getCalculatedValue();
        $bj24 = $spreadsheet->getCell('BJ24')->getCalculatedValue();

        if ($ai45-$ai44 == 0) {
            $output = '';
        } else {
            if ($ai43 == '' && (($ai45-$ai44) < 0)) {
                if (($ai45-$ai44) < (-$bj24)) {
                    $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                    $output = __("Overall debt to equity reflected a positive trend, reducing significantly by :number1%, easing pressure off equity.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                    $output = __("Overall debt to equity reflected slight improvements, reducing by :number1%, easing some pressure off equity.", ['number1' => $number1]);
                }
            } else {
                if ($ai43 == "" && (($ai45-$ai44)>0)) {
                    if (($ai45-$ai44)>$bj24) {
                        $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                        $output = __("Overall debt to equity showed significant deterioration and increased pressure on equity, increasing by :number1% over the years.", ['number1' => $number1]);
                    } else {
                        $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                        $output = __("Overall debt to equity has seen a marginal increase by :number1%, a deterioration trend over the years which could lead to increased pressure on equity over the years.", ['number1' => $number1]);
                    }
                } else {
                    if ($ai45>$ai44) {
                        $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                        $output = __("Recent year debt to equity ratio reflected increasing pressure on equity from the previous year, increasing by :number1%.", ['number1' => $number1]);
                    } else {
                        $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                        $output = __("Recent year debt to equity ratio showed signs of pressure reduction on equity, decreasing by :number1% from the previous year.", ['number1' => $number1]);
                    }
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD24 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD24Comment($spreadsheet)
    {
        $output = '';
        $ai43 = $spreadsheet->getCell('AI43')->getCalculatedValue();
        $ai44 = $spreadsheet->getCell('AI44')->getCalculatedValue();
        $ai45 = $spreadsheet->getCell('AI45')->getCalculatedValue();
        $bj24 = $spreadsheet->getCell('BJ24')->getCalculatedValue();

        if (($ai45-$ai44) == 0) {
            $output = '';
        } else {
            if ($ai43 == '' && (($ai45-$ai44) < 0)) {
                if (($ai45-$ai44) < (-$bj24)) {
                    $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                    $output = __("Overall debt to equity reflected a positive trend, reducing significantly by :number1%, easing pressure off equity.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                    $output = __("Overall debt to equity reflected slight improvements, reducing by :number1%, easing some pressure off equity.", ['number1' => $number1]);
                }
            } else {
                if ($ai43 == '' && (($ai45-$ai44) > 0)) {
                    if (($ai45-$ai44) > $bj24) {
                        $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                        $output = __("Overall debt to equity showed significant deterioration and increased pressure on equity, increasing by :number1% over the years.", ['number1' => $number1]);
                    } else {
                        $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                        $output = __("Overall debt to equity has seen a marginal increase by :number1%, a deterioration trend over the years which could lead to increased pressure on equity over the years.", ['number1' => $number1]);
                    }
                } else {
                    if ($ai45>$ai44) {
                        $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                        $output = __("Recent year debt to equity ratio reflected increasing pressure on equity from the previous year, increasing by :number1%.", ['number1' => $number1]);
                    } else {
                        $number1 = abs(round(($ai45-$ai44)/$ai44*100, 2));
                        $output = __("Recent year debt to equity ratio showed signs of pressure reduction on equity, decreasing by :number1% from the previous year.", ['number1' => $number1]);
                    }
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE24 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE24Comment($spreadsheet)
    {
        $output = '';
        $ai43 = $spreadsheet->getCell('AI43')->getCalculatedValue();
        $ai44 = $spreadsheet->getCell('AI44')->getCalculatedValue();
        $bk24 = $spreadsheet->getCell('BK24')->getCalculatedValue();

        if ($ai43 == '') {
            $output = '';
        } else {
            if (($ai44-$ai43) == 0) {
                $output = '';
            } else {
                if (($ai44-$ai43) < 0) {
                    if (($ai44-$ai43) < (-$bk24)) {
                        $item1 = $spreadsheet->getCell('D19')->getCalculatedValue();
                        $item1 = $spreadsheet->getCell('D20')->getCalculatedValue();
                        $number1 = abs(round(($ai44-$ai43)/$ai43*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, debt to equity saw a significant year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    } else {
                        $item1 = $spreadsheet->getCell('D19')->getCalculatedValue();
                        $item1 = $spreadsheet->getCell('D20')->getCalculatedValue();
                        $number1 = abs(round(($ai44-$ai43)/$ai43*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, debt to equity saw a year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    }
                } else {
                    if (($ai44-$ai43) > 0) {
                        if (($ai44-$ai43) > $bk24) {
                            $item1 = $spreadsheet->getCell('D19')->getCalculatedValue();
                            $item2 = $spreadsheet->getCell('D20')->getCalculatedValue();
                            $number1 = abs(round(($ai44-$ai43)/$ai43*100, 2));
                            $output = __("Records have also indicated that from :item1 to :item2, debt to equity saw a significant year on year increase by :number1%.", [
                                'item1' => $item1,
                                'item2' => $item2,
                                'number1' => $number1,
                            ]);
                        } else {
                            $item1 = $spreadsheet->getCell('D19')->getCalculatedValue();
                            $item2 = $spreadsheet->getCell('D20')->getCalculatedValue();
                            $number1 = abs(round(($ai44-$ai43)/$ai43*100, 2));
                            $output = __("Records have also indicated that from :item1 to :item2, debt to equity saw a year on year increase by :number1%.", [
                                'item1' => $item1,
                                'item2' => $item2,
                                'number1' => $number1,
                            ]);
                        }
                    }
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve the second comment BF25.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return string|array
     */
    public static function getSecondComment($spreadsheet)
    {
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $bf25 = $sp->getCell('BF25')->getCalculatedValue();
        $ai43 = $sp->getCell('AI43')->getCalculatedValue();
        $bc25 = self::getBC25Comment($sp);
        $bd25 = self::getBD25Comment($sp);
        $be25 = self::getBE25Comment($sp);
        $comment = [];

        if ($ai43 == '') {
            $comment[] = $bd25;
        } else {
            if ($bc25 == '') {
                $comment[] = '';
            } else {
                $comment[] = $bc25;
            }
        }

        if ($bd25 == '') {
            $comment[] = '';
        } else {
            $comment[] = $bd25;
        }

        if ($be25 == '') {
            $comment[] = '';
        } else {
            $comment[] = $be25;
        }

        return $comment;
    }

    /**
     * Retrieve BC25 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBC25Comment($spreadsheet)
    {
        $output = '';
        $an43 = $spreadsheet->getCell('AN43')->getCalculatedValue();
        $an45 = $spreadsheet->getCell('AN45')->getCalculatedValue();
        $bi25 = $spreadsheet->getCell('BI25')->getCalculatedValue();

        if ($an43 == "") {
            $output = "";
        } else {
            if (($an45-$an43) / $an43 < 0) {
                if (($an45-$an43)/$an43 < (-$bi25)) {
                    $output = __("Significant improvements in debt ratio suggest improving assets and liabilities balances observed over the 3 years.");
                } else {
                    $output = __("Improvements in debt ratio suggest improving assets and liabilities balances observed over the 3 years.");
                }
            } else {
                if (($an45-$an43)/$an43>$bi25) {
                    $output = __("Significant increase in pressure on assets by liabilities is observed based on the debt ratio's downward trend over the years.");
                } else {
                    $output = __("Increase in pressure on assets by liabilities is observed based on the debt ratio's downward trend over the years.");
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BD25 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBD25Comment($spreadsheet)
    {
        $output = '';
        $an43 = $spreadsheet->getCell('AN43')->getCalculatedValue();
        $an44 = $spreadsheet->getCell('AN44')->getCalculatedValue();
        $an45 = $spreadsheet->getCell('AN45')->getCalculatedValue();
        $bj25 = $spreadsheet->getCell('BJ25')->getCalculatedValue();

        if ($an43 == "" && (($an45-$an44)<0)) {
            if (($an45-$an44) < (-$bj25)) {
                $number1 = abs(round(($an45-$an44)/$an44*100, 2));
                $output = __("Overall liabilities and assets balances have improved with debt ratio reflecting a significant improvement trend, decreasing by :number1%.", ['number1' => $number1]);
            } else {
                $number1 = abs(round(($an45-$an44)/$an44*100, 2));
                $output = __("Overall liabilities and assets balances have improved slightly with debt ratio reducing by :number1%.", ['number1' => $number1]);
            }
        } else {
            if ($an43 == "" && (($an45-$an44) > 0)) {
                if (($an45-$an44) > $bj25) {
                    $number1 = abs(round(($an45-$an44)/$an44*100, 2));
                    $output = __("Overall liabilities and assets balances have worsened with debt ratio increasing significantly by :number1% over the years.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($an45-$an44)/$an44*100, 2));
                    $output = __("Overall liabilities and assets balances have somewhat improved with debt ratio recording a marginal decline by :number1% over the years.", ['number1' => $number1]);
                }
            } else {
                if ($an45 > $an44) {
                    $number1 = abs(round(($an45-$an44)/$an44*100, 2));
                    $output = __("Recent year debt ratio has increased by :number1% from the previous year, potentially increasing the burden on assets.", ['number1' => $number1]);
                } else {
                    $number1 = abs(round(($an45-$an44)/$an44*100, 2));
                    $output = __("Recent year debt ratio decrease by :number1% from the previous year, potentially reducing burden on assets.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BE25 formula.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getBE25Comment($spreadsheet)
    {
        $output = '';
        $ae43 = $spreadsheet->getCell('AE43')->getCalculatedValue();
        $ae44 = $spreadsheet->getCell('AE44')->getCalculatedValue();
        $an43 = $spreadsheet->getCell('AN43')->getCalculatedValue();
        $an44 = $spreadsheet->getCell('AN44')->getCalculatedValue();
        $bk25 = $spreadsheet->getCell('BK25')->getCalculatedValue();

        if ($an43 == '') {
            $output = '';
        } else {
            if (($an44-$an43) == 0) {
                $output = '';
            } else {
                if (($an44-$an43) < 0) {
                    if (($an44-$an43) < (-$bk25)) {
                        $item1 = $ae43;
                        $item2 = $ae44;
                        $number1 = abs(round(($an44-$an43)/$an43*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, debt ratio saw a significant year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    } else {
                        $item1 = $ae43;
                        $item2 = $ae44;
                        $number1 = abs(round(($an44-$an43)/$an43*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, debt ratio saw a year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    }
                } else {
                    if (($an44-$an43) > 0) {
                        if (($an44-$an43) > $bk25) {
                            $item1 = $ae43;
                            $item2 = $ae44;
                            $number1 = abs(round(($an44-$an43)/$an43*100, 2));
                            $output = __("Records have also indicated that from :item1 to :item2, debt ratio saw a significant year on year increase by :number1%.", [
                                'item1' => $item1,
                                'item2' => $item2,
                                'number1' => $number1,
                            ]);
                        } else {
                            $item1 = $ae43;
                            $item2 = $ae44;
                            $number1 = abs(round(($an44-$an43)/$an43*100, 2));
                            $output = __("Records have also indicated that from :item1 to :item2, debt ratio saw a year on year increase by :number1%.", [
                                'item1' => $item1,
                                'item2' => $item2,
                                'number1' => $number1,
                            ]);
                        }
                    }
                }
            }
        }

        return $output;
    }

}
