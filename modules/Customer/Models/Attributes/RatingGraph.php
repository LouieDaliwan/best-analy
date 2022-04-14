<?php

namespace Customer\Models\Attributes;

use Customer\Models\Attributes\Score;

class RatingGraph {
    
    public static function getRatings($customer)
    {
        $scores = new Score($customer, config('fratio')['ratings_format']);

        return $scores->check();
    }
}