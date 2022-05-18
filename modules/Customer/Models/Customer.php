<?php

namespace Customer\Models;

use Best\Models\Report;
use Index\Models\Index;
use Customer\Models\Detail;
use Laravel\Scout\Searchable;
use Customer\Models\BalanceSheet;
use Customer\Models\ApplicantDetail;
use Customer\Models\FinancialStatement;
use Illuminate\Database\Eloquent\Model;
use Core\Models\Relations\BelongsToUser;
use Core\Models\Accessors\CommonAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Best\Pro\Financial\ProfitAndLossStatement;

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
        'is_fs_has_no_zero_value' => 'boolean',
    ];


    protected $primaryKey = 'id';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    // protected $guarded = [];
    protected $fillable = [
        'name',
        'refnum',
        'code',
        'token',
        'metadata',
        'status',
        'user_id',
        'is_fs_has_no_zero_value'
    ];

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
        return $this->metadata['FileNo'] ?? $this->refnum ?? null;
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

    /**
     * Retrieve customer Details
     *
     * @return \Customer\Models\Detail
     */
    public function detail()
    {
        return $this->hasOne(Detail::class, 'customer_id', 'id');
    }

    /**
     * Retrieve customer Financial Statements
     *
     * @return \Customer\Models\FinancialStatement
     */
    public function statements()
    {
        return $this->hasMany(FinancialStatement::class, 'customer_id', 'id')->orderBy('period', 'asc');
    }

    /**
     * Retrieve customer Applicant Detail
     *
     * @return \Customer\Models\ApplicantDetail
     */
    public function applicant()
    {
        return $this->hasOne(ApplicantDetail::class, 'customer_id', 'id');
    }

    public function sdmiComputation()
    {
        return $this->hasMany(SDMIIndexScore::class, 'customer_id', 'id');
    }
}
