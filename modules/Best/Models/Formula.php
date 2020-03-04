<?php

namespace Best\Models;

use Core\Models\Accessors\CommonAttributes;
use Core\Models\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Survey\Models\Relations\BelongsToSurvey;

class Formula extends Model
{
    use BelongsToUser,
        BelongsToSurvey,
        CommonAttributes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Retrieve the owning formulable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function formulable()
    {
        return $this->morphTo();
    }

    /**
     * Retrieve the owning formulable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reportable()
    {
        return $this->morphTo();
    }
}
