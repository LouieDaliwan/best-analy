<?php

namespace Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Customer\Models\Customer;

class Detail extends Model
{
    protected $table = 'customer_details';

    protected $guarded = [];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id', 'customer_id');
    }
}
