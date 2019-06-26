<?php

namespace Core\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait Typeable
{
    /**
     * The type column key.
     *
     * @var string
     */
    protected $typeKey = 'type';

    /**
     * Gets all categories via given category type.
     *
     * @param  Illuminate\Database\Eloquent\Builder $builder
     * @param  string  $type
     * @param  string $column
     * @return Illuminate\Database\Eloquent\Model
     */
    public function scopeType(Builder $builder, $type, $column = null)
    {
        return $builder->where($column ?? $this->typeKey, $type);
    }
}
