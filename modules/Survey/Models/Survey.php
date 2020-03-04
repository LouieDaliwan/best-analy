<?php

namespace Survey\Models;

use Best\Models\Formula;
use Best\Models\Report;
use Core\Models\Accessors\CommonAttributes;
use Core\Models\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Survey\Models\Relations\HasManyFields;

class Survey extends Model
{
    use BelongsToUser,
        CommonAttributes,
        HasManyFields,
        Searchable,
        SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'forms';

    /**
     * Get the owning formable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function formable()
    {
        return $this->morphTo();
    }

    /**
     * Get the reports for the form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'form_id');
    }

    /**
     * Get the reports for the form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formulas()
    {
        return $this->hasMany(Formula::class, 'form_id');
    }

    /**
     * Retrieve the submission of the logged in
     * user for this survey.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSubmissionAttribute()
    {
        return $this->fields->map(function ($field) {
            return $field->submissionBy(user());
        })->reject(function ($submission) {
            return is_null($submission);
        });
    }

    /**
     * Check if the logged in user
     * have finished answering the survey.
     *
     * @return boolean
     */
    public function isFinished()
    {
        return $this->submission->isNotEmpty();
    }

    /**
     * Check if user is finished with customer.
     *
     * @param  \Customer\Models\Customer $customer
     * @return boolean
     */
    public function isFinishedWithCustomer($customer)
    {
        return $this->fields->map(function ($field) use ($customer) {
            return $field->submissions()
                ->whereUserId(user()->getKey())
                ->whereCustomerId($customer->getKey())
                ->first();
        })->reject(function ($submission) {
            return is_null($submission);
        })->count() > 0;
    }
}
