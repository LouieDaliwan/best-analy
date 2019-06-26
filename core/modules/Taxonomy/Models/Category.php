<?php

namespace Taxonomy\Models;

use Core\Models\Scopes\Typeable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Typeable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
