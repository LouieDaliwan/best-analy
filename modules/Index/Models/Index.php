<?php

namespace Index\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Taxonomy\Models\Taxonomy;

class Index extends Taxonomy
{
    use SoftDeletes;

    /**
     * The Taxonomy type.
     *
     * @var string
     */
    protected $type = 'performance-index';
}
