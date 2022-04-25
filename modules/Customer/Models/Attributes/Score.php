<?php

namespace Customer\Models\Attributes;

use Customer\Models\FinancialStatement;

class Score {

    const INCOMPLETE = 'Incomplete';
    const SCORES_INCOMPLETE = 'Scores_Incomplete';

    protected $customer;

    protected $format;

    public function __construct($customer, $format)
    {
        $this->customer = $customer;
        $this->format = $format;
    }

    public function check()
    {
        $this->getFinancialScore();

        $this->checkAllScores();

        $this->format['smeRatings'] = array_values($this->format['smeRatings']);

        return $this->format;
    }

    protected function getFinancialScore() : void
    {
        $latestStatement = FinancialStatement::whereCustomerId($this->customer->id)
        ->latest('period')
        ->first() ?? null;

        if(! is_null($latestStatement)) {       
            $financial_score = (float) round($latestStatement->toArray()['metadataResults']['ratioAnalysis']['dashboard']['financial_score'],2);

            
            $this->format['smeRatings']['financial_score']['score'] = $financial_score;
            $this->format['answered_index']++;
        }  
    }

    protected function checkAllScores() : void
    {
        foreach ($this->format['smeRatings'] as $smeRating) {
            if($smeRating['score'] == '-') {
                $this->format['overall_score'] = self::INCOMPLETE;
                break;
            } else {
                $this->format['overall_score'] += $smeRating['score'];
            }
        }
        
    }
}