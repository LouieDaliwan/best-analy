<?php

namespace Best\Pro;

class PredictionScoreCard
{
    /**
    * @param array subscores
    * @param string index
    * @author Louie Daliwan
    */
    public static function get(array $subscores, $index)
    {
        return call_user_func_array([PredictionScoreCard::class, "{$index}computation"], [$subscores]);
    }

    protected function BSPIcomputation($subscores)
    {
        $formulas = config('predictionscoreformula.bspi');

        $results = []
        $count = 1;

        foreach($formula as $predictiveKey => $formula){
            !isset($results[$count]) ? : $results[$count];

            if($predictiveKey == 'y6v'){

            } else if ($predictiveKey == 'y9v'){
                $formula[]
            } else  if ($predictiveKey == 'y13v') {

            } else {
                $results[$count] = round(
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
                    $formula[14], 0)
                )
            }

            $count++;
        }

      return $results;

    protected function FMPIcomputation($subscores)
    {
         $formula = config('predictionscoreformula.bspi');
    }

    protected function PMPIcomputation($subscores)
    {
        $formula = config('predictionscoreformula.pmpi');
    }

    protected function HRPIcomputation($subscores)
    {
        $formula = config('predictionscoreformula.hrpi');
    }
}
