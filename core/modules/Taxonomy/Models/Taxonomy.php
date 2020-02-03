<?php

namespace Taxonomy\Models;

use Core\Models\Relations\BelongsToUser;
use Core\Models\Scopes\Typeable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxonomy extends Model
{
    use BelongsToUser,
        SoftDeletes,
        Typeable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'taxonomies';

    /**
     * The Taxonomy type.
     *
     * @var string
     */
    protected $type = 'taxonomy';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where((new static)->typeKey, (new static)->getType());
        });
    }
}
