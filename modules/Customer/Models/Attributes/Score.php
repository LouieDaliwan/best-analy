<?php

namespace Customer\Models\Attributes;

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

        $this->format['smeRatings'] = array_values($this->format['smeRatings']);

        return $this->format;
    }

    protected function getFinancialScore() : void
    {
        $latestStatement = $this->customer->statements()->latest('period')->get()->toArray();
        
        if(count($latestStatement) > 0) {
            
            $financial_score = (float) $latestStatement[0]['metadataResults']['ratioAnalysis']['dashboard']['financial_score'];

            $this->format['smeRatings']['financial_scores']['score'] = $financial_score;
            $this->format['overall_score'] += $financial_score;
        }        
    }
}