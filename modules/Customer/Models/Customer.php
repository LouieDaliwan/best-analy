<?php

namespace Customer\Models;

use Best\Models\Report;
use Core\Models\Accessors\CommonAttributes;
use Core\Models\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Index\Models\Index;

class Customer extends Model
{
    use BelongsToUser,
        CommonAttributes,
        SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all indices belonging to customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function indices()
    {
        return $this->belongsToMany(Index::class, 'customer_taxonomy', 'customer_id', 'taxonomy_id');
    }

    /**
     * Retrieve the customer's reports.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
