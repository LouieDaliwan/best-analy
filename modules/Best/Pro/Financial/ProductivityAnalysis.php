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
                    $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI68:AI68')
                )->flatten()->reject(function ($cell) {
                    return is_null($cell);
                })->values()->toArray(),

                'dataset' => [
                    // Year 1.
                    [
                        'label' => $year1,
                        'data' => collect(
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI69:AI69')
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
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI70:AI70')
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
                            $spreadsheet->getSheetByName('FinancialAnalysisReport')->rangeToArray('AI71:AI71')
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
                self::getComment($spreadsheet),
                // implode('||', self::getComment($spreadsheet)),
            ],
        ];
    }

    /**
     * Retrieve comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return array
     */
    public static function getComment($spreadsheet)
    {
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');

        $ai43 = $sp->getCell('AI43')->getCalculatedValue();
        $bc30 = self::getBC30Comment($sp);
        $bd30 = self::getBD30Comment($sp);
        $be30 = self::getBE30Comment($sp);
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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return string
     */
    public static function getBC30Comment($spreadsheet)
    {
        $output = '';
        $ai69 = $spreadsheet->getCell('AI69')->getCalculatedValue();
        $ai70 = $spreadsheet->getCell('AI70')->getCalculatedValue();
        $ai71 = $spreadsheet->getCell('AI71')->getCalculatedValue();
        $bj30 = $spreadsheet->getCell('BJ30')->getCalculatedValue();

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
                    $number1 = round(($ai71-$ai70)/$ai70*100, 2);
                    $output = __("Experienced a year on year decrease by :number1% from the recent year to the previous year.", ['number1' => $number1]);
                }
            }
        }

        return $output;
    }

    /**
     * Retrieve BC30 comment.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return string
     */
    public static function getBD30Comment($spreadsheet)
    {
        $output = '';
        $ai69 = $spreadsheet->getCell('AI69')->getCalculatedValue();
        $ai71 = $spreadsheet->getCell('AI71')->getCalculatedValue();
        $bi30 = $spreadsheet->getCell('BI30')->getCalculatedValue();

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
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return string
     */
    public static function getBE30Comment($spreadsheet)
    {
        $output = '';
        $ai69 = $spreadsheet->getCell('AI69')->getCalculatedValue();
        $ai70 = $spreadsheet->getCell('AI70')->getCalculatedValue();
        $bk30 = $spreadsheet->getCell('BK30')->getCalculatedValue();
        $d19 = $spreadsheet->getCell('D19')->getCalculatedValue();
        $d20 = $spreadsheet->getCell('D20')->getCalculatedValue();

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
