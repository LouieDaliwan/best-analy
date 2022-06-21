<?php

namespace Best\Services\Supports;

use Customer\Models\Attributes\RatingGraph;
use Illuminate\Support\Facades\Cache;

class OverallScore
{
    public static function compute($indices, $customer, $monthKey)
    {
        $user = auth()->user()->id;

        $keyName = "{$customer->id}-Overall-{$user}-{$monthKey}";
        $sdmiName = "{$customer->id}-SDMI-{$user}-{$monthKey}";

        if( cache($keyName)) {
            Cache::forget($keyName);
        }

        if( cache($sdmiName)) {
            Cache::forget($sdmiName);
        }
      
        $collect = collect($indices);

        $ratingGraph = RatingGraph::getRatings($customer);
        
        $financialScore = $ratingGraph['smeRatings'][5]['score'];
        
        $sdmi = $customer->sdmiComputation()->where('month_key', $monthKey)->first();

        $sdmiIndex = $sdmi->metadata['index'] ?? 0;

        Cache::remember($sdmiName, 60*60*24*30, function() use ($sdmiIndex){
            return $sdmiIndex;
        });
        
        $exists_section_score_zero = $collect->map(function ($index) {
            return $index['subscore:score'] == 0;
        })->contains(true);

        if ($exists_section_score_zero) {
            Cache::forget($keyName);
            return 0;
        }

        $totalOf4Index = round($collect->map(function ($index) {

            if ($index['subscore:score'] == 0) {
                return 0 * $index['pindex:weightage'];
            }

            $avg = $index['subscore:total'] != 0 ? $index['subscore:score']/$index['subscore:total'] : 0;
            return $avg*$index['pindex:weightage'];

        })->sum(), 2);
        
        $results = round($totalOf4Index + round(($financialScore * 0.3), 2) + round(($sdmiIndex * 0.2), 2), 1);   

        return Cache::remember($keyName, 60*60*24*30, function() use ($results){
            return $results;
        });;
    }
}