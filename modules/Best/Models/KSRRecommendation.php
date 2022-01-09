<?php

namespace Best\Models;

use Illuminate\Database\Eloquent\Model;

class KSRRecommendation extends Model
{
    protected $table = 'ksr_recommendations';

    protected $guarded = [];

    protected $casts = [
        'metadata' => 'array',
    ];

}
