<?php

namespace Best\Pro;

class PredictionScoreCard
{
    /**
    * @param model object fields
    * @param string index
    * @author Louie Daliwan
    */
    public static function get($fields, $index)
    {
        return call_user_func_array([PredictionScoreCard::class, "{$index}computation"], [self::getSubScores($fields), $index]);
    }

    protected static function BSPIcomputation($subscores, $index)
    {
        $formulas = self::predictionScoreFormula($index);

        $results = [];
        $count = 1;

        foreach($formulas as $predictiveKey => $formula){

            !isset($results[$count]) ? : $results[$count];

            if(in_array($predictiveKey,  self::specialPredictiveKeys())){

                $subScoreIndex = self::getSubScoresIndex($predictiveKey);

                $result =
                    ($formula[0] * pow($subscores[$subScoreIndex], 3)) +
                    ($formula[1] * pow($subscores[$subScoreIndex], 2)) +
                    ($formula[2] * $subscores[$subScoreIndex]) +
                    $formula[3];

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

            $results[$count] = round($result, 0);
            $count++;
        }

      return $results;
    }

    protected static function FMPIcomputation($subscores, $index)
    {
        $formulas = self::predictionScoreFormula($index);
        $results = [];
        $count = 1;
        !isset($results[$count]) ? : $results[$count];

        foreach($formulas as $predictiveKey => $formula){
            if(in_array($predictiveKey,  self::specialPredictiveKeys())) {

                $subScoreIndex = self::getSubScoresIndex($predictiveKey);

                if(count($formulas[$predictiveKey]) == 5){
                     $result =
                        ($formula[0] * pow($subscores[$subScoreIndex], 4)) +
                        ($formula[1] * pow($subscores[$subScoreIndex], 3)) +
                        ($formula[2] * pow($subscores[$subScoreIndex], 2)) +
                        ($formula[3] * $subscores[$subScoreIndex]) +
                        $formula[4];
                }

                if(count($formulas[$predictiveKey]) == 4){
                     $result =
                        ($formula[0] * pow($subscores[$subScoreIndex], 3)) +
                        ($formula[1] * pow($subscores[$subScoreIndex], 2)) +
                        ($formula[2] * $subscores[$subScoreIndex]) +
                        $formula[3];
                }
            } else {
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
            }

            $results[$count] = round($result, 0);
            $count++;
        }

        return $results;
    }

    protected static function PMPIcomputation($subscores)
    {
        $formulas = self::predictionScoreFormula($index);
    }

    protected static function HRPIcomputation($subscores)
    {
        $formulas = self::predictionScoreFormula($index);
    }

    protected static function predictionScoreFormula($index)
    {
        return config("predictionscoreformula.{$index}");
    }

    protected static function getSubScores($fields)
    {
        $subscores = [];

        foreach($fields as $field){
            $subscores[] = $field->submissions()->latest()->first()->metadata['subscore'];
        }

        return $subscores;
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
