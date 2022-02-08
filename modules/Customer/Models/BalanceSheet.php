<?php

namespace Customer\Models;

use Customer\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class BalanceSheet extends Model
{
    protected $guarded = [];

    protected $table = 'customer_balance_sheets';

    protected $casts = [
        'metadata' => 'array',
    ];

    // protected $hidden = [
    //     'metadata'
    // ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}