<?php

namespace Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Customer\Models\Customer;

class FinancialStatement extends Model
{
    protected $table = 'customer_financial_statements';

    protected $guarded = [];

    protected $casts = [
        'metadataStatements' => 'array',
        'metadataSheets' => 'array',
        'metadataResults' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
