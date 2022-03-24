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
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getReport($statements, $customer)
    {
        $spreadsheet = self::getSpreadsheet($customer);
        $labels = ['Debt to Equity Ratio', 'Debt Ratio'];

        return [
            'charts' => [
                'labels' => $labels,
                'dataset' => self::formatDataSet($statements),
            ],

            'comments' => [
                self::getFirstComment($statements),
                self::getSecondComment($statements, $spreadsheet),
            ],
        ];
    }

    protected static function formatDataSet($statements)
    {
        $data = [];

        $ratios = ['debt_to_equity_ratio', 'debt_ratio'];

        foreach ($statements as $statement) {

            $tempData = [];

            $solvency = $statement['metadataResults']['ratioAnalysis']['solvency'];

            foreach ($ratios as $item) {
                $value =  $solvency[$item];
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
     * Retrieve the first comment.
     *
     * @param  \Customer\Models\FinancialStatement $statements
     * @return string|array
     */
    public static function getFirstComment($statements)
    {

        $ai43 = $statements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];
        $bc24 = collect($statements)->count() == 3 ? self::getBC24Comment($statements) : "";
        $bd24 = collect($statements)->count() == 3 ? self::getBD24Comment($statements) : "";
        $be24 = collect($statements)->count() == 2 ? self::getBE24Comment($statements) : "";
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
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC24Comment($statements)
    {
        $output = null;
        $ai43 = $statements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_to_equity_ratio'];
        $ai44 = $statements[1]['metadataResults']['ratioAnalysis']['solvency']['debt_to_equity_ratio'];
        $ai45 = $statements[2]['metadataResults']['ratioAnalysis']['solvency']['debt_to_equity_ratio'];
        $bj24 = 0.3;

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
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD24Comment($statements)
    {
        $output = '';
        $ai43 = $statements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_to_equity_ratio'];
        $ai44 = $statements[1]['metadataResults']['ratioAnalysis']['solvency']['debt_to_equity_ratio'];
        $ai45 = $statements[2]['metadataResults']['ratioAnalysis']['solvency']['debt_to_equity_ratio'];
        $bj24 = 0.3;

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
     * @param  \Customer\Models\FinancialStatement
     * @return array
     */
    public static function getBE24Comment($statements)
    {
        $output = '';
        $ai43 = $statements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_to_equity_ratio'];
        $ai44 = $statements[1]['metadataResults']['ratioAnalysis']['solvency']['debt_to_equity_ratio'];
        $d19 = $statements[0]['period'];
        $d20 = $statements[1]['period'];
        $bk24 = 0.3;

        if ($ai43 == '') {
            $output = '';
        } else {
            if (($ai44-$ai43) == 0) {
                $output = '';
            } else {
                if (($ai44-$ai43) < 0) {
                    if (($ai44-$ai43) < (-$bk24)) {
                        $item1 = $d19;
                        $item2 = $d20;
                        $number1 = abs(round(($ai44-$ai43)/$ai43*100, 2));
                        $output = __("Records have also indicated that from :item1 to :item2, debt to equity saw a significant year on year decrease by :number1%.", [
                            'item1' => $item1,
                            'item2' => $item2,
                            'number1' => $number1,
                        ]);
                    } else {
                        $item1 = $d19;
                        $item2 = $d20;
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
                            $item1 = $d19;
                            $item2 = $d20;
                            $number1 = abs(round(($ai44-$ai43)/$ai43*100, 2));
                            $output = __("Records have also indicated that from :item1 to :item2, debt to equity saw a significant year on year increase by :number1%.", [
                                'item1' => $item1,
                                'item2' => $item2,
                                'number1' => $number1,
                            ]);
                        } else {
                            $item1 = $d19;
                            $item2 = $d20;
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
    public static function getSecondComment($statements, $spreadsheet)
    {
        $sp = $spreadsheet->getSheetByName('FinancialAnalysisReport');
        $bf25 = $sp->getCell('BF25')->getCalculatedValue();
        $ai43 = $sp->getCell('AI43')->getCalculatedValue();
        $bc25 = collect($statements)->count() == 3 ? self::getBC25Comment($statements) : "";
        $bd25 = collect($statements)->count() == 3 ? self::getBD25Comment($statements) : "";
        $be25 = collect($statements)->count() == 2 ? self::getBE25Comment($statements) : "";
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
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBC25Comment($statements)
    {
        $output = '';
        $an43 = $statements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];
        $an45 = $statements[2]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];
        $bi25 = 0.3;

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
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBD25Comment($statements)
    {
        $output = '';

        $an43 = $statements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];
        $an44 = $statements[1]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];
        $an45 = $statements[2]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];
        $bj25 = 0.3;

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
     * @param  \Customer\Models\FinancialStatement $statements
     * @return array
     */
    public static function getBE25Comment($statements)
    {
        $output = '';
        $ae43 = $statements[0]['period'];
        $ae44 = $statements[1]['period'];
        $an43 = $statements[0]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];
        $an44 = $statements[1]['metadataResults']['ratioAnalysis']['solvency']['debt_ratio'];
        $bk25 = 0.3;

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
