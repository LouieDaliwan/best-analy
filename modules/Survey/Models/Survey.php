<?php

namespace Survey\Models;

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
}
