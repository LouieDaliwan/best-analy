<?php

namespace Survey\Models;

use Core\Models\Accessors\CommonAttributes;
use Core\Models\Relations\BelongsToUser;
use Customer\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use BelongsToUser,
        CommonAttributes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'metadata' => 'json',
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the owning submission model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function submissible()
    {
        return $this->morphTo();
    }

    /**
     * Retrieve the user that this resource belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
