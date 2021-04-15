<?php

namespace Best\Pro;
use Carbon\Carbon;

class PredictionScoreCard
{
    /**
    * @param model object fields
    * @param string index
    * @param month
    * @author Louie Daliwan
    */
    public static function get($fields, $index, $month)
    {
        return call_user_func_array([PredictionScoreCard::class, "computation"], [self::getSubScores($fields, $month), $index]);
    }

    protected static function computation($subscores, $index)
    {
        return self::compute(self::predictionScoreFormula($index), $index, $subscores);
    }

    /**
    * @param array formulas
    * @param string index
    * @param array subscores
    * compute the subscores
    * return array
    */
    protected static function compute($formulas, $index, $subscores)
    {
        $results = [];

        if (empty($subscores)) {
            return $results;
        }

        $count = 1;
        !isset($results[$count]) ? : $results[$count];

        foreach ($formulas as $predictiveKey => $formula) {

            if (in_array($predictiveKey,  self::specialPredictiveKeys())) {

                $subScoreIndex = self::getSubScoresIndex($predictiveKey);

                if (in_array(count($formulas[$predictiveKey]), [6,5,4,3])) {
                    $result = self::computeSpecialPredictive($formulas, $formula, $predictiveKey,$subscores, $subScoreIndex);
                }
            } else {
                if ($index == 'fmpi') {
                    $result =
                        pow($formula[0], $subscores[0]) *
                        pow($formula[1], $subscores[1]) *
                        pow($formula[2], $subscores[2]) *
                        pow($formula[3], $subscores[3]) *
                        pow($formula[4], $subscores[4]) *
                        pow($formula[5], $subscores[5]) *
                        pow($formula[6], $subscores[6]) *
                        pow($formula[7], $subscores[7]) *
                        pow($formula[8], $subscores[8]) *
                        pow($formula[9], $subscores[9]) *
                        pow($formula[10], $subscores[10]) *
                        pow($formula[11], $subscores[11]) *
                        pow($formula[12], $subscores[12]) *
                        pow($formula[13], $subscores[13]) *
                        $formula[14];
                } else {

                    $result =
                        ($subscores[0] * $formula[0]) +
                        ($subscores[1] * $formula[1]) +
                        ($subscores[2] * $formula[2]) +
                        ($subscores[3] * $formula[3]) +
                        ($subscores[4] * $formula[4]) +
                        ($subscores[5] * $formula[5]) +
                        ($subscores[6] * $formula[6]) +
                        ($subscores[7] * $formula[7]) +
                        ($subscores[8] * $formula[8]) +
                        ($subscores[9] * $formula[9]) +
                        ($subscores[10] * $formula[10]) +
                        ($subscores[11] * $formula[11]) +
                        ($subscores[12] * $formula[12]) +
                        ($subscores[13] * $formula[13]) +
                        $formula[14];
                }
            }

            $results[$count] = round($result, 0);
            $count++;
        }

        return $results;
    }

    /**
    * @param string index
    * get the formula depend on the index
    * return array
    */
    protected static function predictionScoreFormula($index)
    {
        return config("predictionscoreformula.{$index}");
    }

    /**
    * @param object fields
    * @param object $month
    * get the subscore depends on the date submission
    * return array
    */
    protected static function getSubScores($fields, $month)
    {
        $subscores = [];

        $date = Carbon::parse($month);

        foreach ($fields as $field) {
            $submissions = $field->submissions()
                ->whereMonth('created_at', $date->format('m'))
                ->whereYear('created_at', $date->format('Y'))
                ->first();

            if ($submissions) {
                $subscores[] = $submissions->metadata['subscore'];
            }
        }

        return $subscores;
    }

    /**
    * @param array formulas
    * @param array formula
    * @param array subscores
    * @param string predictiveKey
    * @param string subScoreIndex
    * @author Louie Angelo Daliwan
    * computation for special predictive
    */
    protected static function computeSpecialPredictive($formulas, $formula, $predictiveKey, $subscores, $subScoreIndex)
    {
        if (count($formulas[$predictiveKey]) == 6) {
            $result =
                ($formula[0] * pow($subscores[$subScoreIndex], 5)) +
                ($formula[1] * pow($subscores[$subScoreIndex], 4)) +
                ($formula[2] * pow($subscores[$subScoreIndex], 3)) +
                ($formula[3] * pow($subscores[$subScoreIndex], 2)) +
                ($formula[4] * $subscores[$subScoreIndex]) +
                $formula[5];
        }

        if (count($formulas[$predictiveKey]) == 5) {
             $result =
                ($formula[0] * pow($subscores[$subScoreIndex], 4)) +
                ($formula[1] * pow($subscores[$subScoreIndex], 3)) +
                ($formula[2] * pow($subscores[$subScoreIndex], 2)) +
                ($formula[3] * $subscores[$subScoreIndex]) +
                $formula[4];
        }

        if (count($formulas[$predictiveKey]) == 4) {
             $result =
                ($formula[0] * pow($subscores[$subScoreIndex], 3)) +
                ($formula[1] * pow($subscores[$subScoreIndex], 2)) +
                ($formula[2] * $subscores[$subScoreIndex]) +
                $formula[3];
        }

        if (count($formulas[$predictiveKey]) == 3) {
             $result =
                ($formula[0] * pow($subscores[$subScoreIndex], 2)) +
                ($formula[1] * $subscores[$subScoreIndex]) +
                $formula[2];
        }

        return $result;
    }

    protected static function specialPredictiveKeys()
    {
        return ['y1v', 'y2v', 'y3v','y4v','y5v','y6v','y7v','y8v','y9v','y10v','y11v', 'y12v', 'y13v', 'y14v'];
    }

    protected static function getSubScoresIndex($predictiveKey)
    {
        switch ($predictiveKey) {

        case 'y1v':
            $predictiveKey = '0';
            break;

        case 'y2v':
            $predictiveKey = '1';
            break;

        case 'y3v':
            $predictiveKey = '2';
            break;

        case 'y4v':
            $predictiveKey = '3';
            break;

        case 'y5v':
            $predictiveKey = '4';
            break;

        case 'y6v':
            $predictiveKey = '5';
            break;

        case 'y7v':
            $predictiveKey = '6';
            break;

        case 'y8v':
            $predictiveKey = '7';
            break;

        case 'y9v':
            $predictiveKey = '8';
            break;

        case 'y10v':
            $predictiveKey = '9';
            break;

        case 'y11v':
            $predictiveKey = '10';
            break;

        case 'y12v':
            $predictiveKey = '11';
            break;

        case 'y13v':
            $predictiveKey = '12';
            break;

        case 'y14v':
            $predictiveKey = '13';
            break;

        default:
            $predictiveKey = 'none';
            break;

        }

        return $predictiveKey;
    }
}
