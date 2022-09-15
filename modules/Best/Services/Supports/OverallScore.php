<?php

namespace Best\Services\Supports;

use Customer\Models\Attributes\RatingGraph;
use Illuminate\Support\Facades\Cache;

class OverallScore
{
    public static function compute($indices, $customer, $monthKey)
    {
        logger('Start of Computation of Overall Score');
        $user = auth()->user()->id;

        $keyName = "{$customer->id}-Overall-{$user}-{$monthKey}";
        $sdmiName = "{$customer->id}-BGMI-{$user}-{$monthKey}";

        if(Cache::has($keyName)) {
            Cache::forget($keyName);
        }

        if(Cache::has($sdmiName)) {
            Cache::forget($sdmiName);
        }

        $collect = collect($indices);

        $ratingGraph = RatingGraph::getRatings($customer);

        $financialScore = $ratingGraph['smeRatings'][5]['score'];

        logger("Financial Score {$financialScore}");

        $sdmi = $customer->sdmiComputation()->where('month_key', $monthKey)->first();

        $sdmiIndex = $sdmi->metadata['index'] ?? 0;

        Cache::remember($sdmiName, 60*60*24*30, function() use ($sdmiIndex){
            return round((float) $sdmiIndex, 2);
        });

        $exists_section_score_zero = $collect->map(function ($index) {
            return $index['subscore:score'] == 0;
        })->contains(true);

        if ($exists_section_score_zero) {
            Cache::forget($keyName);
            return 0;
        }

        $bspi = cache("{$customer->id}-BSPI-{$user}-{$monthKey}") ?? 0;
        $fmpi = cache("{$customer->id}-FMPI-{$user}-{$monthKey}") ?? 0;
        $pmpi = cache("{$customer->id}-PMPI-{$user}-{$monthKey}") ?? 0;
        $hrpi = cache("{$customer->id}-HRPI-{$user}-{$monthKey}") ?? 0;

        $totalOf4Index = ($bspi * 0.125) + ($fmpi * 0.125) + ($pmpi * 0.125) + ($hrpi * 0.125);

        $results = round($totalOf4Index + round(($financialScore * 0.3), 2) + round(($sdmiIndex * 0.2), 2), 1);

        return Cache::remember($keyName, 60*60*24*30, function() use ($results){
            return $results;
        });;
    }
}
