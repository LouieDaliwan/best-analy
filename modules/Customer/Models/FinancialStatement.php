<?php

namespace Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Customer\Models\Customer;

class FinancialStatement extends Model
{
    protected $table = 'customer_financial_statements';

    protected $guarded = [];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id', 'customer_id');
    }
}
