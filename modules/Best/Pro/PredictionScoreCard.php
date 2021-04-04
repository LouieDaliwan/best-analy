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
        return call_user_func_array([PredictionScoreCard::class, "{$index}computation"], [self::getSubScores($fields)]);
    }

    protected static function BSPIcomputation($subscores, $index)
    {
        $formulas = self::predictionScoreFormula($index);

        $results = [];
        $count = 1;

        foreach($formulas as $predictiveKey => $formula){

            !isset($results[$count]) ? : $results[$count];

            if($predictiveKey == 'y6v'){
                $result =
                    ($formula[0] * pow($subscores[5], 3)) +
                    ($formula[1] * pow($subscores[5], 2)) +
                    ($formula[2] * $subscores[5]) +
                    $formula[3];
            } else if ($predictiveKey == 'y9v'){
                $result =
                    ($formula[0] * pow($subscores[8], 3)) +
                    ($formula[1] * pow($subscores[8], 2)) +
                    ($formula[2] * $subscores[8]) +
                    $formula[3];
            } else  if ($predictiveKey == 'y13v') {
                $result =
                    ($formula[0] * pow($subscores[12], 3)) +
                    ($formula[1] * pow($subscores[12], 2)) +
                    ($formula[2] * $subscores[12]) +
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

    protected static function FMPIcomputation($subscores)
    {
         $formulas = self::predictionScoreFormula($index);
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
        return config("predictionscoreformula.{$index}")
    }

    protected static function getSubScores($fields)
    {
        $subscores = [];

        foreach($fields as $field){
            $subscores[] = $field->submissions()->latest()->first()->metadata['subscore'];
        }

        return $subscores;
    }
}
