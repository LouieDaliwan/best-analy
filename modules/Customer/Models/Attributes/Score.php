<?php

namespace Customer\Models\Attributes;

use Carbon\Carbon;
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
        // dd(auth()->user());
        $user = auth()->user()->id;

        $monthKey = Carbon::now()->format('m-Y');

        $this->getFinancialScore();

        $this->format['smeRatings']['bspi']['score'] = cache("{$this->customer->id}-BSPI-{$user}-{$monthKey}") ?? 0;
        $this->format['smeRatings']['fmpi']['score'] = cache("{$this->customer->id}-FMPI-{$user}-{$monthKey}") ?? 0;
        $this->format['smeRatings']['pmpi']['score'] = cache("{$this->customer->id}-PMPI-{$user}-{$monthKey}") ?? 0;
        $this->format['smeRatings']['hrpi']['score'] = cache("{$this->customer->id}-HRPI-{$user}-{$monthKey}") ?? 0;
        $this->format['smeRatings']['bgmi']['score'] = cache("{$this->customer->id}-BGMI-{$user}-{$monthKey}") ?? 0;

        if($this->customer->statements()->count() > 0) {
            $this->format['overall_score'] = cache("{$this->customer->id}-Overall-{$user}-{$monthKey}") ?? 0;
            $this->format['results'] = cache("{$this->customer->id}-Overall-{$user}-{$monthKey}") ?  cache("{$this->customer->id}-results-{$user}-{$monthKey}")  ?? ['comment' => 'N/A']: ['comment' => 'N/A'];
        } else {
            $this->format['overall_score'] = 'Incomplete';
            $this->format['results'] = ['comment' => 'N/A'];
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
