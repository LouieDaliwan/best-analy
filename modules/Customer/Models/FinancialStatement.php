<?php

namespace Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Customer\Models\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialStatement extends Model
{
    use SoftDeletes;

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
