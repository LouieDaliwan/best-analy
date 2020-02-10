<?php

namespace Index\Models;

use Core\Models\Accessors\CommonAttributes;
use Customer\Models\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Survey\Models\Survey;
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
}
