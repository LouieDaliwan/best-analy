<?php

namespace Customer\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerUser extends Pivot
{
    protected $casts = [
        'is_business_counselor' => 'boolean'
    ];
}
