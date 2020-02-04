<?php

namespace Survey\Models\Relations;

use Survey\Models\Field;

trait HasManyFields
{
    /**
     * Get the fields for the form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->hasMany(Field::class, 'form_id');
    }
}
