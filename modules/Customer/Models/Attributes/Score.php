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
        $latestStatement = $this->customer->statements()->latest('period')->get();

        if($latestStatement->isNotEmpty()) {
            $this->format['smeRatings']['financial_scores']['score'] = (float) $latestStatement->metadataResults['dashboard']['financial_score'];
            $this->format['overall_score'] += $latestStatement->metadataResults['dashboard']['financial_score'];
        }        
    }
}