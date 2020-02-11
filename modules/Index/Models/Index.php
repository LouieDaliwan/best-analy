<?php

namespace Index\Models;

use Core\Models\Accessors\CommonAttributes;
use Customer\Models\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Survey\Models\Survey;
use Taxonomy\Models\Taxonomy;

class Index extends Taxonomy
{
    use CommonAttributes,
        Searchable,
        SoftDeletes;

    /**
     * The Taxonomy type.
     *
     * @var string
     */
    protected $type = 'performance-index';

    /**
     * Get all customers belonging to index.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_taxonomy', 'taxonomy_id', 'customer_id');
    }

    /**
     * Retrieve the customer resource via the
     * survey attached to the Index and Customer.
     *
     * @param  \Survey\Models\Survey $survey
     * @return \Customer\Models\Customer
     */
    public function getCustomerViaSurvey(Survey $survey)
    {
        return $this->customers()->where('form_id', $survey->getKey())->first();
    }

    /**
     * Retrieve the survey this resource belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function surveys()
    {
        return $this->morphMany(Survey::class, 'formable');
    }

    /**
     * Retrieve the first survey for the index.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getSurveyAttribute()
    {
        return $this->surveys->first();
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
}
