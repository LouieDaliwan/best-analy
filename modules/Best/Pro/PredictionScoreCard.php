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
        return $this->computation($subscores, $index);
    }

    protected function computation($subscores, $index)
    {
        $formula = config('predictionscoreformula.' . $index);

        $results = []
        for($i = 1, $i == count($subscores), $i++){
            $formula[]
        }

        return $results;
    }
}
