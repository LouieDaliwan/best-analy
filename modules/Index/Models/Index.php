<?php

namespace Index\Models;

use Core\Models\Accessors\CommonAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Taxonomy\Models\Taxonomy;

class Index extends Taxonomy
{
    use CommonAttributes,
        SoftDeletes;

    /**
     * The Taxonomy type.
     *
     * @var string
     */
    protected $type = 'performance-index';
}
