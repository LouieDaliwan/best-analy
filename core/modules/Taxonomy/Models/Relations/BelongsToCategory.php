<?php

namespace Taxonomy\Models\Relations;

use Taxonomy\Models\Category;

trait BelongsToCategory
{
    /**
     * Retrieve the category that this resource belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Retrieve the category name of the resource.
     *
     * @return string
     */
    public function getCategorizationAttribute()
    {
        return $this->category->name ?? null;
    }
}
