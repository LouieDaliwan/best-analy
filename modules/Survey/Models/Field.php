<?php

namespace Survey\Models;

use Core\Models\Accessors\CommonAttributes;
use Illuminate\Database\Eloquent\Model;
use Survey\Models\Relations\BelongsToSurvey;
use Survey\Models\Relations\MorphManySubmissions;

class Field extends Model
{
    use BelongsToSurvey,
        CommonAttributes,
        MorphManySubmissions;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
