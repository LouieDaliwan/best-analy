<?php

namespace Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Customer\Models\Customer;

class FinancialStatement extends Model
{
    protected $table = 'customer_financial_statements';

    protected $guarded = [];

    protected $primaryKey = 'customer_id';

    protected $casts = [
        'metadata' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
