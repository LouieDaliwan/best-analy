<?php

namespace Survey\Models;

use Best\Models\Report;
use Core\Models\Accessors\CommonAttributes;
use Core\Models\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Survey\Models\Relations\HasManyFields;

class Survey extends Model
{
    use BelongsToUser,
        CommonAttributes,
        HasManyFields,
        SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'forms';

    /**
     * Get the owning formable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function formable()
    {
        return $this->morphTo();
    }

    /**
     * Get the reports for the form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'form_id');
    }
}
