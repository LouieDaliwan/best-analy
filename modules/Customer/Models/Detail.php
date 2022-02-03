<?php

namespace Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Customer\Models\Customer;

class Detail extends Model
{
    protected $table = 'customer_details';

    protected $primaryKey = 'customer_id';

    protected $guarded = [];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
