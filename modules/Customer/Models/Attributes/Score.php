<?php

namespace Customer\Models\Attributes;

use Customer\Models\FinancialStatement;

class Score {

    const COMPLETE = 'Complete';
    const SCORES_INCOMPLETE = 'Scores_Incomplete';

    protected $customer;

    protected $format;

    public function __construct($customer, $format = null)
    {
        $this->customer = $customer;
        $this->format = $format ?? config('fratio')['ratings_format'];
    }

    public function check()
    {
        $user = auth()->user()->id;
        
        $this->getFinancialScore();
        
        $this->format['smeRatings']['bspi']['score'] = cache("{$this->customer->id}-BSPI-{$user}") ?? 0;
        $this->format['smeRatings']['fmpi']['score'] = cache("{$this->customer->id}-FMPI-{$user}") ?? 0;
        $this->format['smeRatings']['pmpi']['score'] = cache("{$this->customer->id}-PMPI-{$user}") ?? 0;
        $this->format['smeRatings']['hrpi']['score'] = cache("{$this->customer->id}-HRPI-{$user}") ?? 0;
        $this->format['smeRatings']['sdmi']['score'] = cache("{$this->customer->id}-SDMI-{$user}") ?? 0;

        if($this->customer->statements()->count() > 0) {
            $this->format['overall_score'] = cache("{$this->customer->id}-Overall-{$user}") ?? 0;
            $this->format['results'] = cache("{$this->customer->id}-Overall-{$user}") ?  cache("{$this->customer->id}-results-{$user}") : self::SCORES_INCOMPLETE; 
        } else {
            $this->format['overall_score'] = 'Incomplete';
            $this->format['results'] = 'N/A';
        }
                
        $this->format['smeRatings'] = array_values($this->format['smeRatings']);

        $this->checkAnsweredScore($this->format['smeRatings']);        

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

    protected function checkAnsweredScore($smeRatings) {
        foreach($smeRatings as $rating) {
            if($rating['score'] > 0) {
                $this->format['answered_index']++;
            }
        }
    }
}