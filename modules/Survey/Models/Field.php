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
        Concerns\HaveEventsWithParams,
        MorphManySubmissions;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'metadata' => 'json',
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * User exposed observable events.
     *
     * These are extra user-defined events observers may subscribe to.
     *
     * @var array
     */
    protected $observables = [
        'submitted',
    ];

    public function sortBy()
    {
        return $this->orderBy('sort');
    }
}
