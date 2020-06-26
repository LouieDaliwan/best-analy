<?php

namespace Customer\Models;

use Best\Models\Report;
use Best\Pro\Financial\ProfitAndLossStatement;
use Core\Models\Accessors\CommonAttributes;
use Core\Models\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Index\Models\Index;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use BelongsToUser,
        CommonAttributes,
        Searchable,
        SoftDeletes;

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
        return $this->hasMany(Report::class);
    }

    /**
     * Retrieve the overall report for the customer if available.
     *
     * @return mixed
     */
    public function getReportAttribute()
    {
        return $this->reports->first();
    }

    /**
     * Retrieve the business councelor name from CRM.
     *
     * @return string
     */
    public function getCounselorAttribute()
    {
        return $this->metadata['BusinessCounselorName'] ?? null;
    }

    /**
     * Retrieve the business councelor name from CRM.
     *
     * @return string
     */
    public function getFilenumberAttribute()
    {
        return $this->metadata['FileNo'] ?? null;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return array_merge($this->toArray(), [
            'metadata' => json_encode($this->metadata),
        ]);
    }

    /**
     * Retrieve the metadata formatted for the CRM.
     *
     * @return array
     */
    public function getMetadataForCrm()
    {
        return [
            'Revenue' => ''
        ];
    }
}
