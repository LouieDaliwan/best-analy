<?php

namespace Survey\Models;

use Core\Models\Accessors\CommonAttributes;
use Core\Models\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use BelongsToUser,
        CommonAttributes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the owning submission model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function submissible()
    {
        return $this->morphTo();
    }
}
