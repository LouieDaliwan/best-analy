<?php

namespace Customer\Models;

use Customer\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class ApplicantDetail extends Model
{
    protected $guarded = [];

    protected $table = 'customer_applicant_details';

    protected $primaryKey = 'customer_id';

    protected $casts = [
        'metadata' => 'array'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
